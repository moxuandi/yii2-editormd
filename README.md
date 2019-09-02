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

在`Controller`中添加:
```php

```

在`View`中添加:
```php
1. 简单调用:
$form->field($model, 'content')->widget('moxuandi\editormd\Editormd');

2. 带参数调用:
$form->field($model, 'content')->widget('moxuandi\editormd\Editormd', [
    'editorOptions' => [
        'width' => '100%',
        'height' => 640,
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
```

编辑器相关配置，请在视图`view`中配置，参数为`editorOptions`，比如定制菜单，编辑器大小等等，[可用配置项](https://github.com/pandao/editor.md/blob/master/editormd.js#L91)如下:

| 配置项 | 类型 | 默认值 | 配置说明 |
| ------------ | ------------ | ------------ | ------------ |
| mode | string | "gfm" |  |
| name | string | "" |  |
| value | string | "" |  |
| theme | string | "" |  |
| editorTheme | string | "default" |  |
| previewTheme | string | "" |  |
| markdown | string | "" |  |
| appendMarkdown | string | "" |  |
| width | string | "100%" |  |
| height | string | "100%" |  |
| path | string | "./lib/" |  |
| pluginPath | string | "" |  |
| delay | int | 300 |  |
| autoLoadModules | bool | true |  |
| watch | bool | true |  |
| placeholder | string | "Enjoy Markdown! coding now..." |  |
| gotoLine | bool | true |  |
| codeFold | bool | false |  |
| autoHeight | bool | false |  |
| autoFocus | bool | true |  |
| autoCloseTags | bool | true |  |
| searchReplace | bool | true |  |
| syncScrolling | bool | true |  |
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
| imageUpload | bool | false |  |
| imageFormats | array | ["jpg", "jpeg", "gif", "png", "bmp", "webp"] |  |
| imageUploadURL | string | "" |  |
| crossDomainUpload | bool | false |  |
| uploadCallbackURL | string | "" |  |
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
