<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TemplateHeaderRepeaterField extends Model
{
    protected $table = 'template_header_repeater_fields';

    protected $primaryKey = 'id_header_repeater_field';

    protected $fillable = [
        'id_template_header',
        'label',
        'name',
        'type',
    ];

    public function templateHeaderSection(): BelongsTo
    {
        return $this->belongsTo(
            TemplateHeaderSection::class,
            'id_template_header',
            'id_template_header'
        );
    }
}
