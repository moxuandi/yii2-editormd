<?php
namespace moxuandi\editormd;

use moxuandi\helpers\Uploader;
use Yii;
use yii\base\Action;
use yii\web\Response;

/**
 * editor.md 接收上传图片控制器.
 *
 * @author zhangmoxuan <1104984259@qq.com>
 * @link http://www.zhangmoxuan.com
 * @QQ 1104984259
 * @Date 2019-9-2
 */
class UploaderAction extends Action
{
    /**
     * @var array 上传配置信息接口
     */
    public $config = [];


    public function init()
    {
        parent::init();
        Yii::$app->request->enableCsrfValidation = false;  // 关闭csrf
        $_config = [
            'maxSize' => 1*1024*1024,  // 上传大小限制, 单位B, 默认1MB, 注意修改服务器的大小限制
            'allowFiles' => ['.jpg', '.jpeg', '.gif', '.png', '.bmp', '.webp'],  // 允许上传的文件类型
            'pathFormat' => '/uploads/image/{yyyy}{mm}{dd}/{hh}{ii}{ss}_{rand:6}',  // 文件保存路径
            'rootPath' => dirname(Yii::$app->request->scriptFile),
            'rootUrl' => Yii::$app->request->hostInfo,
        ];
        $this->config = array_merge($_config, $this->config);
    }

    /**
     * @throws yii\base\Exception
     */
    public function run()
    {
        // 生成上传实例对象并完成上传
        $upload = new Uploader('editormd-image-file', $this->config);

        // 输出响应结果
        $response = Yii::$app->response;
        $response->format = Response::FORMAT_JSON;
        $response->data = [
            'success' => $upload->status ? 0 : 1,  // 0:表示上传失败; 1:表示上传成功
            'message' => Uploader::$stateMap[$upload->status],
            'url' => $upload->fullName,
        ];
        $response->send();
    }
}
