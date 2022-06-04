<?php
/**
 * Link Master plugin for Craft CMS 3.x
 *
 * Simplify linking in Craft
 *
 * @link      https://zhuk.app
 * @copyright Copyright (c) 2022 Vadim Goncharov
 */

namespace zhukapp\linkmaster;

use Craft;
use craft\base\ElementInterface;
use craft\helpers\Html;
use yii\db\Schema;
use zhukapp\linkmaster\assets\LinkMasterAsset;

class Field extends \craft\base\Field
{
    /**
     * @inheritdoc
     */
    public static function displayName(): string
    {
        return Craft::t('link-master', 'Link Master');
    }

    /**
     * @inheritdoc
     */
    public function init(): void
    {
        parent::init();
    }

    /**
     * @inheritdoc
     */
    public function getContentColumnType(): array|string
    {
        return Schema::TYPE_TEXT;
    }

    protected function inputHtml(mixed $value, ?ElementInterface $element = null): string
    {
        $id = Html::id($this->handle);

        $view = Craft::$app->getView();
        $view->registerAssetBundle(LinkMasterAsset::class);
        $view->registerJs('new LinkMaster.Link("'. $id .'");');

        return $view->renderTemplate('link-master/fields/LinkMaster/input', [
            'id' => $id,
            'name' => $this->handle,
            'value' => $value,
            'field' => $this,
        ]);
    }
}