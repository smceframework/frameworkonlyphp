<!DOCTYPE html>

<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->

<html class="not-ie" lang="en">
<!--<![endif]-->
    
<head>
<meta charset="utf-8">
<meta name="description" content="description" />
<meta name="keywords" content="keywords"/>
<meta name="author" content="BRKOR" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>


<!-- google web font-->
<link href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,400,300,600,700' rel='stylesheet' type='text/css'>

<!-- style sheets-->
<link rel="stylesheet" media="all" href="<?=Smce::app()->baseUrl?>/front/css/bootstrap.css" type="text/css"/>
<link rel="stylesheet" media="all" href="<?=Smce::app()->baseUrl?>/front/css/custom.css" type="text/css"/>

<!-- main jquery libraries / others are at the bottom-->
<script src="<?=Smce::app()->baseUrl?>/front/js/jquery.min.js" type="text/javascript"></script>
<script src="<?=Smce::app()->baseUrl?>/front/js/modernizr.js" type="text/javascript"></script>

<title>Samed Ceylan</title>

<meta content="Samed Ceylan" name="og:title" property="og:title">

<meta content="Merhaba benim adım Samed Ceylan. Yaşamım boyunca etkin iletişim yeteneğim ve olumlu insan ilişkileri sayesinde çok sayıda sorunun çözümünde rol aldım. Bilgisayar programcılığı ve teknolojinin her alanında etkin kullanımı için gerekli olan bilimsel alt yapıya sahip sektörel gelişime katkı verebilecek düzeyde teorik ve pratik bilgilerle donatılmış, problem çözme, araştırma yapma ve iletişim yetenekleri gelişmiş, takım çalışmasına yatkın uzman yazılımcıyım..." name="og:description" property="og:description">

<meta content="Merhaba benim adım Samed Ceylan. Yaşamım boyunca etkin iletişim yeteneğim ve olumlu insan ilişkileri sayesinde çok sayıda sorunun çözümünde rol aldım. Bilgisayar programcılığı ve teknolojinin her alanında etkin kullanımı için gerekli olan bilimsel alt yapıya sahip sektörel gelişime katkı verebilecek düzeyde teorik ve pratik bilgilerle donatılmış, problem çözme, araştırma yapma ve iletişim yetenekleri gelişmiş, takım çalışmasına yatkın uzman yazılımcıyım..." name="description" property="description">

<meta content="Samed Ceylan,yazılım,php,php5,jquery,jqueryui,javascript,mvc,oop,smce,smceframework,yii,psr-0,psr-1,psr-2,psr-3,psr-4,Amazon Web Services AWS S3,Amazon Web Services AWS EC2,lamp,Restful Web Service,Restful,xml,soap,mysql,html,css,yazılım uzmanı,yazılım geliştirme,yazılım geliştirme uzmanı" name="keywords">

<meta content="<?=Smce::app()->baseUrl?>/front/img/face.jpg" name="og:image" property="og:image">

</head>
<body>

<!-- Settings -->
<div class="settings">
    <span class="glyphicon glyphicon-cog"></span>
    <a class="btn active top-white">Beyaz Tema</a>
    <a class="btn top-dark">Siyah Tema</a>
</div>
<!-- end Settings -->

<!-- Top icons -->
<a class="top-menu hidden-xs hidden-sm" data-toggle="tooltip" data-placement="top" title="Menu Aç/Kapat"><span class="glyphicon glyphicon-th-list"></span></a>
<a class="top-contact hidden-xs hidden-sm" data-toggle="tooltip" data-placement="top" title="İletişim"><span class="glyphicon glyphicon-send"></span></a>
<!-- end Top icons -->

<!-- Navigation -->
<nav id="spy" class="spy hidden-sm hidden-xs">
    <ul>
        <li class="active"><a href="#profile">Kişisel Bilgiler</a></li>
        <li><a href="#work-experience">İş Tecrübesi</a></li>
        <li><a href="#professional-skills">Yetkinlikler</a></li>
        <li><a href="#portfolio">Projeler</a></li>
        <li><a href="#education">Eğitim Bilgileri</a></li>
        <li><a href="#sertifika">Sertifikalar</a></li>
        <li><a href="#seminerler">Seminerler</a></li>
        <li><a href="#personal-skills">Kişisel Yetkinlikler</a></li>
        <li><a href="#contact">İletişim</a></li>
    </ul>
</nav>
<!-- end Navigation -->
    
<!-- Navigation for small devices -->
<nav id="mini-nav" class="spy visible-sm visible-xs">
    <ul>
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown">Menu</a>
            <ul class="dropdown-menu">
                <li class="active"><a href="#profile">Kişisel Bilgiler</a></li>
                <li><a href="#work-experience">İş Tecrübesi</a></li>
                <li><a href="#professional-skills">Yetkinlikler</a></li>
                <li><a href="#portfolio">Projeler</a></li>
      		    <li><a href="#education">Eğitim Bilgileri</a></li>
                <li><a href="#sertifika">Sertifikalar</a></li>
                <li><a href="#seminerler">Seminerler</a></li>
       		    <li><a href="#personal-skills">Kişisel Yetkinlikler</a></li>
                <li><a href="#contact">İletişim</a></li>
            </ul>
        </li>
      </ul>
</nav>
<!-- end Navigation for small devices -->
    
<!-- Header -->
<header id="header">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 col-sm-offset-2 text-center">
                <img src="<?=Smce::app()->baseUrl?>/front/img/face.jpg" class="face" alt="">
                <hr class="empty">
                <p class="header-name">Samed Ceylan</p>
                <p class="header-title">Bilgisayar Yazılım Uzmanı ve Bilgisayar Yazılım Geliştirme Uzmanı</p>
                <p class="header-subtitle"><b>Merhaba benim adım Samed Ceylan.</b>  Yaşamım boyunca etkin iletişim yeteneğim ve olumlu insan ilişkileri sayesinde çok sayıda sorunun çözümünde rol aldım. Bilgisayar programcılığı ve teknolojinin her alanında etkin kullanımı için gerekli olan bilimsel alt yapıya sahip sektörel gelişime katkı verebilecek düzeyde teorik ve pratik bilgilerle donatılmış, problem çözme, araştırma yapma ve iletişim yetenekleri gelişmiş, takım çalışmasına yatkın uzman yazılımcıyım. Paylaşılmayan bilgi, bilgi olmadığının savunucusuyumdur. 10 sene aşkın yazılım sektöründe deneyimim bulunmaktadır. </p>
            </div>
        </div>
    </div>
</header>
<!-- end Header -->
	
<!-- Profile -->
<section id="profile" class="profile activate">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-5">
                <ul>
                    <li class="title"><span class="glyphicon glyphicon-user"></span>Kişisel Bilgiler</li>
                    <li>
                        <span class="note">Ad Soyad</span>
                        <p><strong>Samed Ceylan</strong></p>
                    </li>
                    <li>
                        <span class="note">Yaşam</span>
                        <p><strong>İstanbul/Eyüp, Türkiye</strong></p>
                    </li>
                    <li>
                        <span class="note">Doğum</span>
                        <p><strong>01 Mayıs 1987</strong></p>
                        <p><strong>Kırıkkale, Türkiye</strong></p>
                    </li>
                    
                    <li>
                        <span class="note">LinkedIn Özgeçmiş</span>
                        <p><strong><a href="https://tr.linkedin.com/pub/samed-ceylan/69/275/370" target="_blank">https://tr.linkedin.com/pub/samed-ceylan/69/275/370</a></strong></p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end Profile -->

<!-- Work experience -->
<section id="work-experience" class="work-experience">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-5">
                <ul>
                    <li class="title"><span class="glyphicon glyphicon-briefcase"></span>İş Tecrübesi</li>
                    <li>
                        <span class="note">Kasım 2012 - Devam Ediyor</span>
                        <p><strong><b>Bilgiodası Veritabanı ve İletişim Platform Hizmetleri</b></strong></p>
                        <p><strong>Bilgisayar Yazılım Uzmanı</strong> İstanbul Türkiye</p>
                        <p class="description">PHP, PHP5, MySQL, C#, Yii Framework, jQuery, jQuery UI, javascript,CSS, SVN, HTML, MVC, OOP, SEO, Refactoring, LAMP, Ubuntu, Apache, Windows, AMAZON AWS</p>
                    </li>
                    <li>
                        <span class="note">Temmuz 2012 - Agustos 2012</span>
                        <p><strong><b>isbulurum.com</b></strong></p>
                        <p><strong>Bilgisayar Yazılım Uzmanı</strong> İstanbul Türkiye</p>
                        <p class="description">PHP, PHP5, MySQL, CodeIgniter Framework, jQuery, jQuery UI, javascript,CSS, SVN, HTML, MVC, OOP, SEO, Facebook API, Refactoring </p>
                    </li>
                    <li>
                        <span class="note">Mart 2012 - Temmuz 2012</span>
                        <p><strong><b>AKINSOFT SOFTWARE ENGINEERING</b></strong></p>
                        <p><strong>Bilgisayar Yazılım Uzmanı</strong> Konya Türkiye</p>
                        <p class="description">PHP, PHP5, MySQL, Yii Framework, jQuery, jQuery UI, javascript,CSS, HTML, MVC, OOP, SEO, Refactoring </p>
                    </li>
                    <li>
                        <span class="note">Şubat 2012 - Mart 2012</span>
                        <p><strong><b>Ovalı FORD Motorlu Araçlar - Stajyer</b></strong></p>
                        <p><strong>Bilgisayar Yazılım Uzmanı</strong> Hatay Türkiye</p>
                        <p class="description">Web tasarım ve programlama, Windows Uygulama Programlama,Grafik tasarım, Servis / Bakım / Onarım </p>
                    </li>
                    <li>
                        <span class="note">Temmuz 2010 - Ağustos 2010</span>
                        <p><strong><b>Mustafa Kemal İskenderun MYO</b></strong></p>
                        <p><strong>Stajyerı</strong> Hatay Türkiye</p>
                        <p class="description">Windows Uygulama Programlama (C#), Servis / Bakım / Onarım </p>
                    </li>
                    <li>
                        <span class="note">Ocak 2006 - Aralık 2006</span>
                        <p><strong><b>Saray Elektoronik ve Bilgisayar</b></strong></p>
                        <p><strong>Teknik Servis, Satış Elamanı</strong> Kırıkkale Türkiye</p>
                        <p class="description">Teknik Servis, Satış Elamanı</p>
                    </li>
                      <li>
                        <span class="note">Ocak 2006 - Ocak 2012</span>
                        <p><strong><b>Freelance</b></strong></p>
                        <p><strong>Programlama</strong> Türkiye</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end Work experience -->

<!-- Professional skills -->
<section id="professional-skills" class="professional-skills">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-5">
                <ul>
                    <li class="title"><span class="glyphicon glyphicon-tasks"></span>Yetkinlikler</li>
                    
                    <li>
                        <p>PHP/PHP5<span class="annotation pull-right">95%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                     <li>
                        <p>PSR-0, PSR-1, PSR-2, PSR-3 , PSR-4, Kod Standartı<span class="annotation pull-right">90%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                     <li>
                        <p>Smce Framework - <b>Kendim Programladım</b><span class="annotation pull-right">100%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                     <li>
                        <p>Yii Framework<span class="annotation pull-right">90%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                     <li>
                        <p>Codeigniter Framework<span class="annotation pull-right">65%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                   
                    <li>
                        <p>MySQL<span class="annotation pull-right">90%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    <li>
                        <p>Javascript<span class="annotation pull-right">80%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    <li>
                        <p>JQuery<span class="annotation pull-right">95%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    
                    <li>
                        <p>JQuery UI<span class="annotation pull-right">80%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    
                    <li>
                        <p>MVC<span class="annotation pull-right">100%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                     <li>
                        <p>OOP<span class="annotation pull-right">90%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    <li>
                        <p>Amazon Web Services AWS S3<span class="annotation pull-right">95%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    <li>
                        <p>Amazon Web Services AWS EC2<span class="annotation pull-right">50%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                     <li>
                        <p>LAMP<span class="annotation pull-right">90%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    <li>
                        <p>GITHUB - Windows<span class="annotation pull-right">90%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    <li>
                        <p>SVN - Windows<span class="annotation pull-right">70%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    
                    <li>
                        <p>CSS<span class="annotation pull-right">95%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    <li>
                        <p>HTML<span class="annotation pull-right">95%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    <li>
                        <p>C#<span class="annotation pull-right">55%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    <li>
                        <p>Restful Web Service<span class="annotation pull-right">95%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    <li>
                        <p>SOAP<span class="annotation pull-right">75%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                    <li>
                        <p>XML Web Service<span class="annotation pull-right">75%</span></p>
                        <div class="progress">
                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </li>
                    
                  
                    
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end Professional skills -->

<!-- Portfolio -->
<section id="portfolio" class="portfolio">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-5">
                <ul>
                    <li class="title"><span class="glyphicon glyphicon-eye-open"></span>Projeler</li>
                     <li>
                        <p><strong><b>Smce Framework - Mvc</b></strong></p>
                        <p><a href="https://github.com/imadige/smceframework-MVC" target="_blank">https://github.com/imadige/smceframework-MVC</a></p>
                        <p class="description">Kendi yazdığım PHP5 frameworktür.<br>
                            Yapısı:<br><br>
                            
                            1) MVC<br>
                            
                            2) Autoload<br>
                            
                            3) Validation<br>
                            
                            4) Masterpage/Layout<br>
                            
                            5) Temlate Engine<br>
                            
                            6) MySQL DB<br>
                            
                            7) Accses Rules Yapısı<br>
                            
                            8) Servisler<br>
                            
                            
                            8) ...<br><br>
                            
                            <p style="font-size:11px;color:#055198">Not: Ayrıca şuan bu site Smce Framework üzerinde çalışmaktadır.</p>
                            
                         </p>
                    </li>
                    
                     <li>
                        <p><strong><b>TimePath WorkSheet</b></strong></p>
                        <p><a href="http://www.timepath.net" target="_blank">http://www.timepath.net</a></p>
                        <p class="description">Kullanılan: Yii Framework, SURFERWIN’s, PHP5 , JQUERY, JQUERY UI, Javascript, CSS, MySQL, Highcharts Javascript API, C#, SqLite<br><br>

Müşteri ve personel verimliliğini ölçümlemenin en kolay yolu olan TimePath, kolay yönetim paneli ve gelişmiş raporlama araçları ile masaüstü Windows’un yanı sıra mobil platformlarda.
                         </p>
                    </li>
                    
                    <li>
                        <p><strong><b>SURFERWIN’s Desktop Javascript kütüphanesi</b></strong></p>
                        <p><a href="http://www.surferwins.com" target="_blank">http://www.surferwins.com</a></p>
                        <p class="description">Kullanılan kütüphanede:  Javascript, JQUERY, JQUERY UI, CSS<br><br>
Kullanılan web sitesinde: Yii Framework, SURFERWIN’s, PHP5 , JQUERY, JQUERY UI, Javascript, CSS, MySQL<br><br>

SURFERWIN’s kendimin yazdığı bir web masaüstü kütüphanesidir. Bu kütüphaneye www.surferwins.com adresinden ücretsiz ulaşabilirsiniz. Ve ayrıca DEMO girişi yapıp uygulamayı inceleyebilirsiniz. Projenin başdan sona geliştirilmesi kendime ait.
                         </p>
                    </li>
                    
                    <li>
                        <p><strong><b>AKINSOFT SMS SİSTEMİ</b></strong></p>
                        <p class="description">Kullanılan: Yii Framework, PHP5 , JQUERY, CSS, XML Web Servis<br><br>
                        AKINSOFT şirketinde çalışırken yapmış olduğum sms sistemi projesidir. Xml kullanılarak tek sms veya excelde toplu sms atılabiliniyor.
                         </p>
                    </li>
                    
                     <li>
                        <p><strong><b>AKINSOFT KARİYER</b></strong></p>
                        <p class="description">Kullanılan: Yii Framework, PHP5 , JQUERY, CSS<br><br>
                        AKINSOFT şirketinde çalışırken yapmış olduğum kariyer web sitesidir.
                         </p>
                    </li>
                    
                     <li>
                        <p><strong><b>OVALI 2</b></strong></p>
                        <p><a href="http://www.ovali2.com" target="_blank">http://www.ovali2.com</a></p>
                        <p class="description">Kullanılan: PHP, CSS, JQUERY, MySQL, Photoshop<br><br>
                        Araba satış portalı.
                         </p>
                    </li>
                    
                     <li>
                        <p><strong><b>PAW Müzik Kutusu</b></strong></p>
                        <p class="description">Kullanılan: Visual C#<br><br>
                        Okul yıllarında kantimize geliştirmiş oldugum müzik kutusu yazılımı.
                         </p>
                    </li>
                    
                    <li>
                        <p><strong><b>PAW Message Encryption 1.0.0</b></strong></p>
                        <p class="description">Kullanılan: Visual C#<br><br>
                        Okul yıllarında geliştirmiş olduğum, 512 bitlik kriptoloji kütüpahanesi.
                         </p>
                    </li>
                    
                    <li>
                        <p><strong><b>PAW Okul kart basma programı</b></strong></p>
                        <p class="description">Kulllanılan: Visual C#, MS Access<br><br>
                        Okul yıllarında geliştirmiş olduğum okul kartlarını basma programı.
                         </p>
                    </li>
                    
                    <li>
                        <p><strong><b>PAW Mku Öğrenci Otomasyon Programı</b></strong></p>
                        <p class="description">Kulllanılan: Visual C#, MS Access<br><br>
                        Okul yıllarında geliştirmiş olduğum okul öğrenci otomasyon programı.
                         </p>
                    </li>
                    
                     <li>
                        <p><strong><b>PAW Öğretim Elemanları Ders Yükü</b></strong></p>
                        <p class="description">Kulllanılan: Visual C#, MS Access<br><br>
                        Okul yıllarında geliştirmiş olduğum öğretim elemanları Ders yükü programı.
                         </p>
                    </li>
                    
                    <li>
                        <p><strong><b>Ovalı Çalışanların Prim Listesi Programı</b></strong></p>
                        <p class="description">Kulllanılan: Visual C#, MS Access<br><br>
                        Ovalı 'da stajerlik yaptığım zaman geliştirmiş oldugum yazılım.
                         </p>
                    </li>
                    
                    <li>
                        <p><strong><b>2004 senesinde web tabanlı oyun geliştirmiş</b></strong></p>
                        <p class="description">Kullanılan: Klasik ASP<br><br>
2004 senesinde ilk ağrım ilk projem olan www.wonderwars.com adlı web tabanlı oyun geliştirmiş olmam.
                         </p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end Portfolio -->
    
<!-- Education -->
<section id="education" class="education">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-5">
                <ul>
                    <li class="title"><span class="glyphicon glyphicon-book"></span>Eğitim Bilgileri</li>
                    <li>
                        <span class="note">Eylül 2012 - Devam Ediyor</span>
                        <p><strong>Üniversite - Lisans</strong></p>
                        <p><strong><b>Anadolu Üniversitesi - (Açık Öğretim)</b></strong> İşletme</p>
                    </li>
                    <li>
                        <span class="note">Eylül 2009 - Eylül 2012</span>
                        <p><strong>Üniversite - Ön Lisans</strong></p>
                        <p><strong><b>Mustafa Kemal İskenderun Meslek Yüksek Okulu</b></strong> Bilgisayar Teknolojileri</p>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end Education -->


<!-- sertifika -->
<section id="sertifika" class="personal-skills">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-5">
                <ul>
                    <li class="title"><span class="glyphicon glyphicon-book"></span>Sertifikalar</li>
                    <li>
                        <p><strong><b>Certificate </b></strong></p>
                        <p>UNIACADEMIY - 12.2012 </p>
                        <p class="description">50 saatlik INTERAKTİF Kişisel Gelişim, NLP, Motivasyon, Stres Yönetimi, Zaman Yönetim, Beden Dili...</p>
                    </li>
                    
                    <li>
                        <p><strong><b>Certificate </b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                        <p class="description">
10 Saatlk İnteraktif NLP Beginner eğitmi almış olup, NLP Pratictitioner Eğitimini Almya Hak kazandı</p>
                    </li>
                    
                     <li>
                        <p><strong><b>Eğitim Sertifikası </b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                        <p class="description">STRATEJİK YÖETİM Başarıyla tamamlayarak bu sertifakayı hak kazanmıştır. </p>
                    </li>
                    
                    <li>
                        <p><strong><b>ISO 9001:2008 Internal Assessor </b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                    </li>
                    
                    <li>
                        <p><strong><b>ISO 14001 Çevre Yönetim Sistemi </b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                        
                    </li>
                    
                    <li>
                        <p><strong><b>Eğitim Sertifikası </b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                        <p class="description">Entegre Yönetim eğitimini başarıyla tamamlayarak bu sertifikayı almaya hak kazanmıştır. </p>
                    </li>
                    
                    <li>
                        <p><strong><b>Referans </b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                        <p class="description">UNIACADEMIY tarafımızdan almış oldugu eğitime istinaden yazılmıştır. </p>
                    </li>
                    
                    <li>
                        <p><strong><b>ISO 14001 Environmental Managament System </b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                        
                    </li>
                    
                    <li>
                        <p><strong><b>ISO 9001:2008 Kalite Yönetim Sistemi </b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                        
                    </li>
                    
                    <li>
                        <p><strong><b>OHSAS 18001 İş Sağlığı ve Güvenliği</b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                       
                    </li>
                    
                    <li>
                        <p><strong><b>ISO 9001:2008 İş Tetikçi</b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                    </li>
                    
                    <li>
                        <p><strong><b>ISO 9001:2008 Quality Managament System </b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                       
                    </li>
                    
                    <li>
                        <p><strong><b>Strategic Managament </b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                      
                    </li>
                    
                    <li>
                        <p><strong><b>ISO 22000 Food Safety Managament System </b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                        
                    </li>
                    
                    <li>
                        <p><strong><b>ISO 22000 Gıda Güvenliği Yönetim Sistemi </b></strong></p>
                        <p>UNIACADEMIY - 12.2012</p>
                        
                    </li>
                    
                    <li>
                        <p><strong><b>Başarıya Dair </b></strong></p>
                        <p>innovation academy - 05.2012</p>
                        <p class="description">innovation academy düzenlediği "BAŞARIYA DAİR" adlı kişisel gelişim seminerine katıldım </p>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end sertifika -->
    
<!-- seminerler -->
<section id="seminerler" class="seminerler">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-5">
                <ul>
                    <li class="title"><span class="glyphicon glyphicon-book"></span>Seminerler</li>
                    
                    <li>
                        <p><strong><b>GDG DevFest</b></strong></p>
                        <p>İstanbul , 2013</p>
                        <p class="description">Google tarafından düzenlenen ve yazılımcıları bir araya getiren dünyaca ünlü organizasyon</p>
                    </li>
                    
                     <li>
                        <p><strong><b>OWASP</b></strong></p>
                        <p>İstanbul , 2013</p>
                        <p class="description">Seminer süresince OWASP Top 10 2013 güvenlik zafiyeti başlıkları örnek uygulama ve kod parçalarıyla  değerlendirilerek daha güvenli yazılım geliştirilmesi için dikkat edilmesi gereken hususlar, yazılım güvenliği testleri için kullanılacak açık kaynak, ticari yazılımlar ve tecrübeler paylaşıldı.</p>
                    </li>
                    
                    <li>
                        <p><strong><b>PHP Günleri</b></strong></p>
                        <p>www.php-tr.com - İstanbul , 2013 </p>
                        <p class="description">Refactoring, Spagetti Koddan Nasıl Kurtulurum? Phalcon - Eklenti Olarak Sunulan PHP Çatısısı Olay Güdümlü Mimari PHP'de Güvenlik Veritabanı Yüksek Trafikli Projelerde PHP Geliştirme </p>
                    </li>
                    
                    <li>
                        <p><strong><b>At şu adımı - ahmet şerif izgören</b></strong></p>
                        <p>Ahmet şerif izgören - iskenderun Primemal , 2012 </p>
                        <p class="description">Kişisel gelişim.</p>
                    </li>
                    
                    <li>
                        <p><strong><b>BAŞARIYA DAİR</b></strong></p>
                        <p>innovation academy , 2012 </p>
                        <p class="description">innovation academy düzenlediği BAŞARIYA DAİR adlı kişisel gelişim seminerine katıldım.</p>
                    </li>
                    
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end seminerler -->

    
<!-- Personal skills -->
<section id="personal-skills" class="personal-skills">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-5">
                <ul>
                    <li class="title"><span class="glyphicon glyphicon-stats"></span>Kişisel Yetkinlikler</li>
                    <li>
                    	<span class="chart" data-percent="95"><span class="skill">Liderlik</span>
                            <span class="percent"></span>
                        </span>
                        <span class="chart" data-percent="95"><span class="skill">Yaratıcılık</span>
                            <span class="percent"></span>
                        </span>
                        <span class="chart" data-percent="99"><span class="skill">Strateji</span>
                            <span class="percent"></span>
                        </span>
                        <span class="chart" data-percent="85"><span class="skill">Kontrol</span>
                            <span class="percent"></span>
                        </span>
                        <span class="chart" data-percent="95"><span class="skill">Girişkenlik</span>
                            <span class="percent"></span>
                        </span>
                        <span class="chart" data-percent="95"><span class="skill">Esneklik</span>
                            <span class="percent"></span>
                        </span>
                        <span class="chart" data-percent="99"><span class="skill">Bilgi Paylaşımı</span>
                            <span class="percent"></span>
                        </span>
                        <span class="chart" data-percent="99"><span class="skill">Empati</span>
                            <span class="percent"></span>
                        </span>
                        
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end Personal skills -->
 
    
<!-- Contact -->
<section id="contact" class="contact">
    <div class="container">
        <div class="row">
            <div class="col-sm-7 col-sm-offset-5">
                <ul>
                    <li class="title"><span class="glyphicon glyphicon-envelope"></span>İletişim</li>
                    <li class="static">
                        <span class="note">E-Posta</span>
                        <p><strong>imadige@gmail.com</strong></p>
                        <hr class="empty">
                        
                    </li>
                    <li class="up"><span class="glyphicon glyphicon-arrow-up"></span>Yukarı</li>
                </ul>
            </div>
        </div>
    </div>
</section>
<!-- end Contact -->

<div style="height:200px;"></div>

<!-- Java Script -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="<?=Smce::app()->baseUrl?>/front/js/bootstrap.min.js"></script>
<script src="<?=Smce::app()->baseUrl?>/front/js/bootstrap-progressbar.js"></script>
<script src="<?=Smce::app()->baseUrl?>/front/js/spy.js"></script>
<script src="<?=Smce::app()->baseUrl?>/front/js/scripts.js"></script>
<!-- Charts -->
<script src="<?=Smce::app()->baseUrl?>/front/js/jquery.easypiechart.js"></script>
<script src="<?=Smce::app()->baseUrl?>/front/js/chart.js"></script>

</body>
</html>