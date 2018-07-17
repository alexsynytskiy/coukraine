<?php

use yii\db\Schema;
use yii\db\Migration;
use yii\easyii\modules\artist\models\Artist;
use yii\easyii\models\Module;

class m170613_153947_artist_module extends Migration
{
    const VERSION = 0.9;

    public $engine = 'ENGINE=MyISAM DEFAULT CHARSET=utf8';
    
    public function up()
    {
        //NEWS MODULE
        $this->createTable(Artist::tableName(), [
            'artist_id' => 'pk',
            'title'     => Schema::TYPE_STRING . '(128) NOT NULL',
            'image'     => Schema::TYPE_STRING . '(128) DEFAULT NULL',
            'short'     => Schema::TYPE_STRING . '(1024) DEFAULT NULL',
            'text'      => Schema::TYPE_TEXT . ' NOT NULL',
            'slug'      => Schema::TYPE_STRING . '(128) DEFAULT NULL',
            'time'      => Schema::TYPE_INTEGER .  " DEFAULT '0'",
            'views'     => Schema::TYPE_INTEGER . " DEFAULT '0'",
            'status'    => Schema::TYPE_BOOLEAN . " DEFAULT '1'"
        ], $this->engine);
        $this->createIndex('slug', Artist::tableName(), 'slug', true);

        $this->insert(Module::tableName(), [
            'name'      => 'artist',
            'class'     => 'yii\easyii\modules\artist\ArtistModule',
            'title'     => 'Артист',
            'icon'      => 'pencil',
            'settings'  => '[]',
            'notice'    => '0',
            'order_num' => '200',
            'status'    => 1,
        ]);
    }

    public function down()
    {
        $this->dropTable(Artist::tableName());
        $this->delete(Module::tableName(), 'class = yii\easyii\modules\artist\ArtistModule');
    }
}
