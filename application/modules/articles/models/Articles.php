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
    public $uid;

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
} 