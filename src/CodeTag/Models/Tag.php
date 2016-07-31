<?php

namespace CodePress\CodeTag\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $table = 'codepress_tags';
    private $validator;

    public function setValidator($validator)
    {
        $this->validator = $validator;
    }

    public function getValidator()
    {
        return $this->validator;    
    }

    public function taggable()
    {
        return $this->morphTo();
    }

    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable', 'codepress_taggables');
    }

    protected $fillable = ['name', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Tag::class);
    }

    public function children()
    {
        return $this->hasMany(Tag::class, 'parent_id');
    }

    public function isValid()
    {
        $validator = $this->validator;
        $validator->setRules(['name' => 'required|max:255']);
        $validator->setData($this->attributes);
        return !$validator->fails();
    }

}
