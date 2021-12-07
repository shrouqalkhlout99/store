<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use phpDocumentor\Reflection\Types\Self_;
use function Ramsey\Uuid\v1;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'parent_id',
        'Slug',
        'status',
        'description',

    ];
    //
    public function getNameAttribute($value){
if($this->trashed()){
    return $value .'(Deleted)';
}
return $value;
    }
    //

    public function getOriginalNameAttribute(){
return $this->attributes=['name'];
    }
//العلاقات بين الجداول
    public function Products(){
        return $this->hasMany(product::class,'category_id','id');
    }
    public function children(){
        return $this->hasMany(Category::class,'parent_id','id');
    }
    public function parent(){
        return $this->belongsTo(self::class,'parent_id','id')->withDefault([
            'name'=>'Not Parent',
        ]);
    }

}
