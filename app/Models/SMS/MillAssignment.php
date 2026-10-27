<?php


namespace App\Models\SMS;


use Illuminate\Database\Eloquent\Model;

class MillAssignment extends Model
{
    protected $table = 'mill_assignments';

    public function sugarMill()
    {
        // foreign key on mill_assignments, owner key on sugar_mills
        return $this->belongsTo(SugarMills::class, 'mill_code', 'slug');
    }

}