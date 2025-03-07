<?php



namespace App\Traits;



trait SortScopes
{

    public function scopeSort($query, $field, $value)
    {
    //    dd($query, $field, $value);
        if($value == true)
        {
            $value = 'ASC' ;
        }else if($value == false){
            $value = 'DESC' ;
        }
       
        return $query->when(!empty($value), function ($query) use ($field, $value) {

            $query->OrderBy($field, $value);

        });

    }


    // public function scopeSearch($query, $field, $value)
    // {

    //     return $query->when(!empty($value), function ($query) use ($field, $value) {

    //         $query->where($field, $value);

    //     });

    // }



    // public function scopeSearchLike($query, $field, $value)
    // {

    //     return $query->when(!empty($value), function ($query) use ($field, $value) {

    //         $query->where($field, 'LIKE', "%{$value}%");

    //     });

    // }

    // public function scopeSearchLikeInRelation($query, $field, $value)
    // {
    //     return $query->when(!empty($value), function ($query) use ($field, $value) {
    //         // Check if the field contains a dot, indicating a relationship
    //         if (strpos($field, '.') !== false) {
    //             list($relation, $relationField) = explode('.', $field);
    //             $query->whereHas($relation, function ($q) use ($relationField, $value) {
    //                 $q->where($relationField, 'LIKE', "%{$value}%");
    //             });
    //         } else {
    //             $query->where($field, 'LIKE', "%{$value}%");
    //         }
    //     });
    // }



    // public function scopeSearchStatus($query, $field, $value)
    // {

    //     return $query->when($this->checkStatus($value), function ($query) use ($field, $value) {

    //         $query->where($field, $value);

    //     });

    // }



    // private function checkStatus($value)
    // {

    //     return (!empty($value) || $value == 0) && $value !== null;

    // }

}

