# bysj  
##**_毕业设计项目 瓦罗兰特商店查询APP及PHP网页_**  
  
**思路：https://www.bilibili.com/video/BV1eP411f7tB**  
**APP界面借鉴IOS商店ValTracker**  
**拳头认证：https://github.com/floxay/python-riot-auth**  
  
##20204/6/17  
APK文件在master分支中可下载  
Valorant压缩包为初版APP源码（无后续功能）  
基础查询功能APP源码尚在，添加武器数据、皮肤数据趣味分析源码由于重装系统丢失  
可通过http://139.199.231.191:4070/all.html 访问  
（其中推荐系统使用1.0页面，2.0可通过http://139.199.231.191:4070/tuijian2.0.html 访问）  
  
  
=====已完成=====  
1.拳头账户登录  
2.获取今日商店API  
3.对比API数据  
4.通过API方式传输至APP  
5.查看今日商店皮肤及预览  
6.武器数据查询  
7.武器皮肤数据趣味分析+推荐（无机器学习 洗牌算法  
  
=====问题=====  
1.默认给予测试账号，且每次重启APP不记录上次键入账号  
2.武器数据页面排版有误  
3.数据分析+推荐系统使用数据库，但我并未编写自动更新数据库的代码，数据将维持在4月16日前的皮肤数据（直到我编写或更新数据库）  
4.API数据对比使用使用了字典，代码较为混乱，懒得修改了，会导致部分皮肤无预览图/视频  
