<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TemplateHeaderSection extends Model
{
    protected $table = 'template_header_sections';

    protected $primaryKey = 'id_template_header';

    protected $fillable = [
        'title',
        'type',
    ];

    public function repeaterFields(): HasMany
    {
        return $this->hasMany(
            TemplateHeaderRepeaterField::class,
            'id_template_header',
            'id_template_header'
        );
    }
}

