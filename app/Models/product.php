<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use NumberFormatter;


class product extends Model
{

    use HasFactory;
    use SoftDeletes;
    const STATUS_ACTIVE ='active';
    const STATUS_DRAFT='draft';


    protected $fillable=[
     'id', 'name_first','image_path','category_id','slug','description','price','sale_price','quantity','sku',
       'weight' ,'width',  'height','length','status'
    ];
    protected $appends = [
        'image_url',
        'formatted_price',
        'permalink',
    ];
    protected static function booted()
    {
        static::creating(function(Product $product) {
            $slug = Str::slug($product->name);

            $count = Product::where('slug', 'LIKE', "{$slug}%")->count();
            if ($count) {
                $slug .= '-' . ($count + 1);
            }
            $product->slug = $slug;
        });
    }

  public function scopeActive(Builder $builder){
$builder->where('products.status','=','active')->get();
 }
  public function scopePrice(Builder $builder, $from,$to=null){
     $builder->where('price','>=',$from);
     if($to !== null){
         $builder->where('price','<=',$to);
     }

 }


    //Accessors get[name]Attribute

public function getImageUrlAttribute(){
    if(! $this->image_path){
        return asset('image/placeholder.png');
    }
    if(stripos($this->image_path,'http')===0){
        return $this->image_path;
    }
    return asset('uploads/'.$this->image_path);
}

// Mutators set[name]Attribute
public  function  setNameAttribute($value){
    $this->attributes['name'] = Str::title($value); //عند اضافة الاسم بأحرف سمول يحفظها بالكابيتال
}

public function getFormatPriceAttribute(){
      $format= new NumberFormatter(App::getLocale(),NumberFormatter::CURRENCY);
      return $format->formatCurrency($this->price,'USD');
}
    public function getFormattedPriceAttribute()
    {
        $fomatter = new NumberFormatter(App::getLocale(), NumberFormatter::CURRENCY);
        return $fomatter->formatCurrency($this->price, 'EUR');
    }

    public function getPermalinkAttribute()
    {
        return route('product.details', $this->slug);
    }

public function Category(){
      return $this->belongsTo(Category::class,'category_id','id')
          ->withDefault();
}
public function user(){
      return $this->belongsTo(User::class,'user_id','id')->withDefault();
}
public function ratings(){
      return $this->morphMany(Rating::clas,'rateable','rateable_type','rateable_id','id');
}

}
