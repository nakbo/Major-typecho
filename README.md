## Krait Major ##

>Major,这是一款采用兼容性开发的 Typecho 主题，科创出品,原创主题,采用兼容性开发!

## General 概括 ##
- Author 作者：[权那他(Krait)][1]
- Version 版本：2.4
- Compatibility 兼容：PHP 7.0+, MySQL, Typecho 1.0+
  - 推荐使用 PHP 7+ 以获得最佳体验
  - 当前测试均在 PHP 7.2 与 Typecho 1.1 正式版下完成，在可能的情况下请尽量接近此环境

## Update Special Notes 更新特别说明 ##
**Major v2.4** 版本即新版本启用用出现一个小问题，如下:
```
Fatal error: Cannot redeclare themeInit() (previously declared in xx/xx/xx/functions.php:266) in xx/xx/xx//functions.php on line 167
```
**原因** 这个原因我也不清楚，反正是函数名冲突，欢迎各位大佬帮我解决。
**临时解决方案:** 新建一个文件夹放在 `themes` 里面，如名为 `typechoSwitch` 里面放仅一个空文件 `index.php` ，然后在后台主题启用它，在转换启用本主题`Major`

## Demo 演示

Experience the Major theme in live: [Krait Major Demo](https://krait.cn)

![Screenshot_2019-02-16-10-41-07-57.png][2]
![Screenshot_2019-02-16-10-41-32-16.png][3]
![Screenshot_2019-02-16-10-41-40-02.png][4]
![Screenshot_2019-02-16-10-41-58-93.png][5]
![Screenshot_2019-02-16-10-42-11-74.png][6]
![Screenshot_2019-02-16-11-05-47-23.png][7]


## Setup 设置

- 在 [Release](https://github.com/kraity/Major/releases) 中下载最新版本，大多数情况下更新可直接覆盖，部分设置需手动启用
- 在“设置外观”中打造一个属于你自己的博客

## Download 下载 ##
Github Major : [https://github.com/kraity/Major][8]

#### File tree 文件树 #### 
```
Major
     assets
           fonts
                toast.eot
                toast.svg
                toast.ttf
                toast.woff
           js
             rgbaster.min.js
             theme.js
             toast.script.js
           vendors
                liveTimeAgo
                           jquery.liveTimeAgo.js
                zoomify
                       zoomify.min.js
     layout
           res
              layout-comments.php
              layout-list.php
              layout-postAuthor.php
              layout-showfoot.php
           layout-404.php
           layout-Major.php
           layout-archive.php
           layout-footer.php
           layout-head.php
           layout-header.php
           layout-index.php
           layout-page.php
           layout-post.php
     lib
        Major.php
     functions.php
     index.php
     layout-about.php
     layout-archives.php
     layout-friend.php
     screenshot.png
     style.css
majors
      HyperDown.php
      Plugin.php
```

## Instructions 使用说明 ##

[https://krait.cn/major/1628.html][9] 因为Major开发必须需要插件才能实现,切记看说明!

## License 许可证 ##
>Open sourced under the MIT license.
>根据 MIT 许可证开源。

## 更新历史 ##
#### 2019-02.16 Update v2.4 ####

 1. Major 结构改变，请先保存主题设置数据，再删除后上传。
 2. 这次更新只要发生结构很大的变化，详细配置到我的博客查看。
 3. Major material mat 头部样式改变。
 4. 优化各种语法问题，优化各种布局问题
 5. 大屏幕和小屏幕均兼容优化。

#### 2018-11.04 Update v2.2 ####

 1. 新增可选主题色
 2. 首页material light块博主区域改变
 
#### 2018-10.03 Update v2.1 ####

 1. 新增主题模版数据备份功能
 2. 解决点击返回按钮无响应的问题
 3. 增加可选择公共库方法
 4. 手机端和电脑端都注重
 5. 新增文章页背景根据图片自动变色
 6. 等等解决了很多错误的方法

#### 2018-08.27 Update v2.0 ####

 1. 新增首页material light块
 2. 将插件里的配置转到主题配置页来配置
 3. 全站用material design风格
 4. 版本2.0注重手机端
 5. 等等，列举不完

#### 2018-04.29 Update v1.9 ####

 1. 抽屉式导航美化
 2. 社交组件图标改成可自定义的方法
 3. 更新插件majors
 4. 更新插件venobox.js
 5. 首页文章列表美化
 6. 文章类型说一说改成状态
 7. 新增文章类型聊天
 8. 新增评论框评论时自动载入头像
 9. 在评论里的头像是先调用gravatar，如该邮箱没有腾讯就调用QQ腾讯
 10. 详细问题到QQ群:452935991 

#### 2018-02.22 Update v1.8 ####

 1. 引入MDUI前端框架
 2. 新增抽屉式导航
 3. 优化加载更多这个函数方法
 4. mat头图进行可控分层渲染
 5. 新增全局分享按钮,去掉文章页脚的分享按钮
 6. 新增快速评论方法
 7. 评论框架美化
 8. 文章显示框架美化
 9. 友情链接的对象框美化
 10. 归档页美化，加入标签云、独立页归档、分类归档
 11. 引语改成说一说的样式
 12. QQ群:452935991 

#### 2018-02.12 Update v1.7 ####
 1. 双栏改为单栏，去掉侧栏
 2. 新增头图显示小菜单
 3. 新增引语文章形式
 4. 新增文章进度导航
 5. 更新美化头图
 6. 更新美化文章展示
 7. 新增可全屏评论编辑框
 8. 新增打赏按钮
 9. 新增可无限循环加载内容
 10. 内置venobox插件技术
 11. 内置toast插件技术
 12. 修复点击页面后滑动条不见的问题
 13. 去掉底部小菜单
 14. 文档页面美化
 15. 友情页面美化
 16. 文章页面美化
 17. 博主信息布局改版
 18. QQ群:452935991 

#### 2017-12.03 Update v1.5 ####
 1. 高端新增博主的INFO
 2. 高端改用管理员的个人信息,不再额外填写个人信息
 3. 新增侧栏，标记分类和最新文章
 4. 新增统计，博客情况和浏览量
 5. 新增底部的小菜单
 6. 新增社交展示
 7. 全站启用instantclick.js
 8. 菜单样式高端美化
 9. 新增打赏组件
 10. 评论样式高端美化
 11. 新增文章页底部的文章信息
 12. 新增浏览量统计
 13. 友情链接里卡片美化
 14. 归档页面美化
 15. QQ群:452935991 

#### 2017-07-27 Update v1.4 ####
 1. 徒手完全重写Major,不再基于chivalric开发,原创主题
 2. 更加实用
 3. 头部大图更加好看
 4. 头部菜单写为侧栏方式
 5. 评论区模仿QQ聊天对话的样子,更加直观
 6. 首页增加了消息区,方便告知访客
 7. QQ群:452935991 

#### 2017-07-x Development v1.0 #### 

 - 自主开发 Krait Major 主题


  [1]: https://krait.cn
  [2]: https://ws3.sinaimg.cn/large/006U7bU2ly1g083twuzonj30u01hcwi6.jpg
  [3]: https://ws3.sinaimg.cn/large/006U7bU2ly1g083uch9dkj30u01hcjv3.jpg
  [4]: https://ws3.sinaimg.cn/large/006U7bU2ly1g083uj8pbsj30u01hc79c.jpg
  [5]: https://ws3.sinaimg.cn/large/006U7bU2ly1g083uoklk3j30u01hc76y.jpg
  [6]: https://ws3.sinaimg.cn/large/006U7bU2ly1g083utwhgmj30u01hcdii.jpg
  [7]: https://ws3.sinaimg.cn/large/006U7bU2ly1g083uy3jj2j30u01hcwgw.jpg
  [8]: https://krait.cn/d/major
  [9]: https://krait.cn/major/1628.html
  [10]: https://krait.cn
