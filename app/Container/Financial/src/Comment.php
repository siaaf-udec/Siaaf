<?php

namespace App\Container\Financial\src;


use App\Container\Financial\src\Constants\SchemaConstant;
use App\Container\Users\Src\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use SoftDeletes;

    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = SchemaConstant::CONNECTION;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = SchemaConstant::COMMENTS;

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = SchemaConstant::PRIMARY_KEY;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        SchemaConstant::COMMENT,
        SchemaConstant::USER_FOREIGN_KEY,
        SchemaConstant::COMMENTABLE_ID,
        SchemaConstant::COMMENTABLE_TYPE,
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [ SchemaConstant::DELETED_AT ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [SchemaConstant::DELETED_AT];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [ 'comment_class' ];

    /*
     * ---------------------------------------------------------
     * Accessors and Mutator Attributes
     * ---------------------------------------------------------
     */

    /**
     * Remove HTML tags
     *
     * @param $comment
     */
    public function setCommentAttribute( $comment )
    {
        $this->attributes[ comment() ] = strip_tags( trim( $comment ) );
    }

    /**
     * Retrieve a html class
     *
     * @return string
     */
    public function getCommentClassAttribute()
    {
        return ( $this->{ user_fk() } == auth()->user()->id ) ? 'in' : 'out';
    }

    /*
     * ---------------------------------------------------------------------------------------
     * Models Relation
     * ---------------------------------------------------------------------------------------
     */

    /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    /**
     * Get user relation
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class,
                                SchemaConstant::USER_FOREIGN_KEY,
                                'id');
    }
}