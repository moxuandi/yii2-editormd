[开源在线 Markdown 编辑器 Editor.md for Yii2](http://editor.md.ipandao.com/)
================

### 主要特性

- 支持“标准”Markdown / CommonMark和Github风格的语法，也可变身为代码编辑器；
- 支持实时预览、图片（跨域）上传、预格式文本/代码/表格插入、代码折叠、搜索替换、只读模式、自定义样式主题和多语言语法高亮等功能；
- 支持ToC（Table of Contents）、Emoji表情、Task lists、@链接等Markdown扩展语法；
- 支持TeX科学公式（基于KaTeX）、流程图 Flowchart 和 时序图 Sequence Diagram;
- 支持识别和解析HTML标签，并且支持自定义过滤标签解析，具有可靠的安全性和几乎无限的扩展性；
- 支持 AMD / CMD 模块化加载（支持 Require.js & Sea.js），并且支持自定义扩展插件；
- 兼容主流的浏览器（IE8+）和Zepto.js，且支持iPad等平板设备；
- 支持自定义主题样式；


安装:
------------
使用 [composer](http://getcomposer.org/download/) 下载:
```
# 2.2.x(yii >= 2.0.24):
composer require moxuandi/yii2-editormd:"~2.2.0"

# 开发版:
composer require moxuandi/yii2-editormd:"dev-master"
```


使用:
-----

在`View`中添加:
```php
1. 简单调用:
$form->field($model, 'content')->widget('moxuandi\editormd\Editormd');

2. 带参数调用:
$form->field($model, 'content')->widget('moxuandi\editormd\Editormd', [
    'editorOptions' => [
        'width' => '100%',
        'height' => 640,
        'imageUpload' => true,  // 启用图片上传
        'watch' => false,  // 关闭实时预览
    ],
]);

3. 不带 $model 调用:
\moxuandi\editormd\Editormd::widget([
    'name' => 'content',
    'value' => '初始值',
    'editorOptions' => [
        'width' => '100%',
        'height' => 640,
    ]
]);

4. 注册js函数和对象:
$form->field($model, 'content')->widget('moxuandi\editormd\Editormd', [
    'editorOptions' => [
        'width' => '100%',
        'height' => 640,
        'toolbarIcons' => new \yii\web\JsExpression('function() {
   return ["save", "undo", "redo", "bold", "italic", "del", "quote", "hr", "image", "link", "list-ul", "list-ol", "code", "code-block", "table"]
}'),
        'toolbarCustomIcons' => new \yii\web\JsExpression('{
    save: "<a><i class=\"fa fa-save\" onclick=\"javascript:save();\"></i></a>"
}'),
    ],
]);
```

在`Controller`中添加(如果不需要图片上传功能, 可以不添加):
```php
public function actions()
{
    return [
        'EditormdUpload' => [
            'class' => 'moxuandi\editormd\UploaderAction',
            'config' => [
                'imageAllowFiles' => ['.jpg', '.jpeg', '.gif', '.png', '.bmp', '.webp'],  // 允许上传的文件类型
                'imagePathFormat' => '/uploads/image/{yyyy}{mm}{dd}/{hh}{ii}{ss}_{rand:6}',  // 文件保存路径
                'modelClass' => 'common\model\Upload',  // 文件信息是否保存入库
                'process' => [  // 二维数组, 将按照子数组的顺序对图片进行处理
                    'match' => ['image', 'process'],  // 图片处理后保存路径的替换规则, 必须是两个元素的数组
                    'thumb' => [  // 缩略图配置
                        'width' => 300,  // 缩略图宽度
                        'height' => 200,  // 缩略图高度
                        'mode' => 'outbound',  // 生成缩略图的模式, 可用值: 'inset'(补白), 'outbound'(裁剪, 默认值)
                    ],
                    'crop' => [  // 裁剪图配置
                        'width' => 300,  // 裁剪图的宽度
                        'height' => 200,  // 裁剪图的高度
                        'top' => 200,  // 裁剪图顶部的偏移, y轴起点, 默认为`0`
                        'left' => 200,  // 裁剪图左侧的偏移, x轴起点, 默认为`0`
                    ],
                    'frame' => [  // 添加边框的配置
                        'margin' => 20,  // 边框的宽度, 默认为`20`
                        'color' => '666',  // 边框的颜色, 十六进制颜色编码, 可以不带`#`, 默认为`666`
                        'alpha' => 100,  // 边框的透明度, 可能仅`png`图片生效, 默认为`100`
                    ],
                    'watermark' => [  // 添加图片水印的配置
                        'watermarkImage' => '/uploads/watermark.png',  // 水印图片的绝对路径
                        'top' => 100,  // 水印图片的顶部距离原图顶部的偏移, y轴起点, 默认为`0`
                        'left' => 200,  // 水印图片的左侧距离原图左侧的偏移, x轴起点, 默认为`0`
                    ],
                    'text' => [  // 添加文字水印的配置
                        'text' => 'TONGMENGCMS',  // 水印文字的内容
                        'fontFile' => '@yii/captcha/SpicyRice.ttf',  // 字体文件, 可以是绝对路径或别名
                        'top' => 100,  // 水印文字距离原图顶部的偏移, y轴起点, 默认为`0`
                        'left' => 200,  // 水印文字距离原图左侧的偏移, x轴起点, 默认为`0`
                        'fontOptions' => [  // 字体属性
                            'size' => 12,  // 字体的大小, 单位像素(`px`), 默认为`12`
                            'color' => 'fff',  // 字体的颜色, 十六进制颜色编码, 可以不带`#`, 默认为`fff`
                            'angle' => 0,  // 写入文本的角度, 默认为`0`
                        ],
                    ],
                    'resize' => [  // 调整图片大小的配置
                        'width' => 300,  // 图片调整后的宽度
                        'height' => 200,  // 图片调整后的高度
                        'keepAspectRatio' => true,  // 是否保持图片纵横比, 默认为`true`
                        'allowUpscaling' => false,  // 如果原图很小, 图片是否放大, 默认为`false`
                    ],
                ],

                // 如果`uploads`目录与当前应用的入口文件不在同一个目录, 必须做如下配置:
                'rootPath' => dirname(dirname(Yii::$app->request->scriptFile)),
                'rootUrl' => 'http://image.advanced.ccc',
            ],
        ],
    ];
}
```


编辑器相关配置，请在视图`view`中配置，参数为`editorOptions`，比如定制菜单，编辑器大小等等，[可用配置项](https://github.com/pandao/editor.md/blob/master/editormd.js#L91)如下:

| 配置项 | 类型 | 默认值 | 配置说明 |
| ------------ | ------------ | ------------ | ------------ |
| mode | string | "gfm" |  |
| name | string | "" |  |
| value | string | "" |  |
| theme | string | "" | 主题 |
| editorTheme | string | "default" |  |
| previewTheme | string | "" |  |
| markdown | string | "" |  |
| appendMarkdown | string | "" |  |
| width | string | "100%" |  |
| height | string | "100%" |  |
| path | string | "./lib/" |  |
| pluginPath | string | "" |  |
| delay | int | 300 | 延迟解析标记为HTML, 单位:ms |
| autoLoadModules | bool | true | 自动加载相关模块文件 |
| watch | bool | true | 是否开启实时预览 |
| placeholder | string | "Enjoy Markdown! coding now..." |  |
| gotoLine | bool | true |  |
| codeFold | bool | false |  |
| autoHeight | bool | false |  |
| autoFocus | bool | true | 是否启用自动对焦编辑器左侧输入区域 |
| autoCloseTags | bool | true |  |
| searchReplace | bool | true | 是否启用搜索和替换功能 |
| syncScrolling | bool | true | 同步滚动, "single"表示单向同步 |
| readOnly | bool | false |  |
| tabSize | int | 4 |  |
| indentUnit | int | 4 |  |
| lineNumbers | bool | true |  |
| lineWrapping | bool | true |  |
| autoCloseBrackets | bool | true |  |
| showTrailingSpace | bool | true |  |
| matchBrackets | bool | true |  |
| indentWithTabs | bool | true |  |
| styleSelectedText | bool | true |  |
| matchWordHighlight | bool | true |  |
| styleActiveLine | bool | true |  |
| dialogLockScreen | bool | true |  |
| dialogShowMask | bool | true |  |
| dialogDraggable | bool | true |  |
| dialogMaskBgColor | string | "#fff" |  |
| dialogMaskOpacity | float | 0.1 |  |
| fontSize | string | "13px" |  |
| saveHTMLToTextarea | bool | false |  |
| disabledKeyMaps | array | [] |  |
| onload | function | function() {} |  |
| onresize | function | function() {} |  |
| onchange | function | function() {} |  |
| onwatch | function | null |  |
| onunwatch | function | null |  |
| onpreviewing | function | function() {} |  |
| onpreviewed | function | function() {} |  |
| onfullscreen | function | function() {} |  |
| onfullscreenExit | function | function() {} |  |
| onscroll | function | function() {} |  |
| onpreviewscroll | function | function() {} |  |
| imageUpload | bool | false | 是否启用图片上传 |
| imageFormats | array | ["jpg", "jpeg", "gif", "png", "bmp", "webp"] | 允许上传的图片格式 |
| imageUploadURL | string | "" | 后端接收图片上传的URL |
| crossDomainUpload | bool | false | 是否启用跨域上传 |
| uploadCallbackURL | string | "" | 跨域上传的回调URL |
| toc | bool | true |  |
| tocm | bool | false |  |
| tocTitle | string | "" |  |
| tocDropdown | bool | false |  |
| tocContainer | string | "" |  |
| tocStartLevel | int | 1 |  |
| htmlDecode | bool | false |  |
| pageBreak | bool | true |  |
| atLink | bool | true |  |
| emailLink | bool | true |  |
| taskList | bool | false |  |
| emoji | bool | false |  |
| tex | bool | false |  |
| flowChart | bool | false |  |
| sequenceDiagram | bool | false |  |
| previewCodeHighlight | bool | true |  |
| toolbar | bool | true |  |
| toolbarAutoFixed | bool | true |  |
| toolbarIcons | string | "full" |  |
| toolbarTitles | object | {} |  |
| toolbarHandlers | object |  |  |
| toolbarCustomIcons | object |  |  |
| toolbarIconsClass | object | {} |  |
| toolbarIconTexts | object | {} |  |
| lang | object |  |  |
