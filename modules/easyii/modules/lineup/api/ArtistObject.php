<?php
namespace yii\easyii\modules\lineup\api;

use Yii;
use yii\easyii\components\API;
use yii\easyii\models\Photo;
use yii\easyii\modules\lineup\models\Item;
use yii\helpers\Url;

class ArtistObject extends \yii\easyii\components\ApiObject
{
    /** @var  string */
    public $slug;

    public $image;

    public $views;

    public $time;

    /** @var  int */
    public $category_id;

    private $_photos;

    public function getTitle(){
        return LIVE_EDIT ? API::liveEdit($this->model->title, $this->editLink) : $this->model->title;
    }

    public function getShort(){
        return LIVE_EDIT ? API::liveEdit($this->model->short, $this->editLink) : $this->model->short;
    }

    public function getText(){
        return LIVE_EDIT ? API::liveEdit($this->model->text, $this->editLink, 'div') : $this->model->text;
    }

    public function getSoundcloud(){
        return $this->model->soundcloud_link;
    }

    public function getFacebook(){
        return $this->model->fb_link;
    }

    public function getTwitter(){
        return $this->model->tw_link;
    }

    public function getInstagram(){
        return $this->model->instagram_link;
    }

    public function getYoutube(){
        return $this->model->youtube_link;
    }

    public function getCats(){
        return Artist::cats()[$this->category_id];
    }

    public function getTags(){
        return $this->model->tagsArray;
    }

    public function getDate(){
        return Yii::$app->formatter->asDate($this->time);
    }

    public function getPhotos()
    {
        if(!$this->_photos){
            $this->_photos = [];

            foreach(Photo::find()->where(['class' => Item::className(), 'item_id' => $this->id])->sort()->all() as $model){
                $this->_photos[] = new PhotoObject($model);
            }
        }
        return $this->_photos;
    }

    public function getEditLink(){
        return Url::to(['/admin/lineup/items/edit/', 'id' => $this->id]);
    }
}