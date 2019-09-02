<?php
namespace moxuandi\editormd;

use moxuandi\helpers\ArrayHelper;
use Yii;
use yii\base\InvalidConfigException;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\helpers\Url;
use yii\widgets\InputWidget;

/**
 * Editormd renders a editor js plugin for classic editing.
 *
 * @author zhangmoxuan <1104984259@qq.com>
 * @link http://www.zhangmoxuan.com
 * @QQ 1104984259
 * @Date 2019-9-2
 * @see http://editor.md.ipandao.com/
 */
class Editormd extends InputWidget
{
    /**
     * @var array 编辑器配置接口
     */
    public $editorOptions = [];
    /**
     * @var array textarea 外层嵌套的 div 的HTML属性
     */
    public $nestingOptions = [];


    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->hasModel() ? $this->id = $this->options['id'] : $this->id = $this->options['id'] = $this->id . '_' . $this->name;
        $this->editorOptions = array_merge([
            'width' => '100%',
            'height' => 640,
            'path' => Yii::$app->assetManager->getBundle(EditormdAsset::class)->baseUrl . '/dist/lib/',
            'imageUploadURL' => Url::to(['EditormdUpload']),
        ], $this->editorOptions);
        $this->nestingOptions = array_merge([
            'id' => 'nesting_' . $this->id,
        ], $this->editorOptions);
    }

    /**
     * 渲染输入域
     * @return string
     */
    public function run()
    {
        self::registerScript();
        $tag = ArrayHelper::remove($this->nestingOptions, 'tag', 'div');
        return Html::tag($tag, $this->hasModel() ? Html::activeTextarea($this->model, $this->attribute, $this->options) : Html::textarea($this->name, $this->value, $this->options), $this->nestingOptions);
    }

    /**
     * 注册客户端脚本
     */
    protected function registerScript()
    {
        EditormdAsset::register($this->view);
        $editorOptions = Json::encode($this->editorOptions);
        $this->view->registerJs("editormd('{$this->nestingOptions['id']}', {$editorOptions});");
    }
}
