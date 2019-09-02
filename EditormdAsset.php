<?php
namespace moxuandi\editormd;

use yii\web\AssetBundle;

/**
 * Asset bundle for the editor.md
 *
 * @author zhangmoxuan <1104984259@qq.com>
 * @link http://www.zhangmoxuan.com
 * @QQ 1104984259
 * @Date 2019-9-2
 * @see http://editor.md.ipandao.com/
 */
class EditormdAsset extends AssetBundle
{
    public $sourcePath = '@vendor/moxuandi/yii2-editormd/assets';
    public $css = [
        'dist/css/editormd.min.css',
    ];
    public $js = [
        'dist/editormd.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}
