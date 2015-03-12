<?php

class Tag extends \Eloquent
{
	protected $table = 'taggable_tags';
	protected $fillable = ['name','ormalized'];

	public function taggable()
	{
		return $this->morphTo();
	}
    public function posts()
    {
        return $this->morphedByMany('Post', 'taggable', 'taggable_taggables');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }
}
