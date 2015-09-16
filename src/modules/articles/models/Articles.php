<?php


namespace Application\Modules\Articles\Models;


use Phalcon\Mvc\Model;

class Articles extends Model
{
    /**
     * @var integer
     */
    public $id;

    /**
     * @var integer
     */
    public $author_id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $created_at;

    /**
     * @var string
     */
    public $updated_at;

    /**
     * @var integer
     */
    public $page_views;

    public function initialize()
    {
        // set values of these attributes by default
        $this->skipAttributesOnCreate(['created_at', 'updated_at', 'page_views']);

        $this->belongsTo('uid', 'Application\Modules\Users\Models\Users', 'id');
    }

    /**
     * @param int $id, the id of the article to be found
     * @return \Phalcon\Mvc\Model
     */
    public static function findFirstById($id)
    {
        return parent::findFirstById((int) $id);
    }
} 