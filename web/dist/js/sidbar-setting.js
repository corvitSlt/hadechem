/**
 * AdminLTE Demo Menu
 * ------------------
 * You should not use this file in production.
 * This file is for demo purposes only.
 */
var id_setting = 0;
function set_id_setting(id){
id_setting = id;
}
function update_setting(entty,val){
	$.ajax({ 
	   type: "POST", 
	   url: "index.php?r=setting%2Fupdate_setting_ajax",
	   data: {
		id: id_setting,
		entity : entty,
		value : val,
	   }, 
	   success: function(dataDetailSetting){
			//alert(dataDetailSetting);
	   }			   
	});
}
(function ($) {
  'use strict'
  var temp_class = "";
  var $control_sidebar   = $('.control-sidebar')
  var $container = $('<div />', {
    class: 'p-3 control-sidebar-content'
  })

  $control_sidebar.append($container)
  var navbar_dark_skins = [
    'navbar-primary',
    'navbar-secondary',
    'navbar-info',
    'navbar-success',
    'navbar-danger',
    'navbar-indigo',
    'navbar-purple',
    'navbar-pink',
    'navbar-navy',
    'navbar-lightblue',
    'navbar-teal',
    'navbar-cyan',
    'navbar-gray-dark',
  ]

  var navbar_light_skins = [
    'navbar-light',
    'navbar-warning',
    'navbar-white',
    'navbar-orange',
  ]

  $container.append(
    '<h5>Pengaturan Tampilan</h5><hr class="mb-2"/>'
  )

  var $no_border_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.main-header').hasClass('border-bottom-0'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-header').addClass('border-bottom-0');
	  update_setting('no_navbar_border',1);
    } else {
      $('.main-header').removeClass('border-bottom-0');
	  update_setting('no_navbar_border',0);
    }
  })

  var $no_border_label = $('<label />',{'class': 'modal-checkbox'}).text('Navbar Border').append($no_border_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $no_border_container = $('<div />', {'class': 'mb-1'}).append($no_border_label)
  $container.append($no_border_container)

	var $position_navbar_fix_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('body').hasClass('layout-navbar-fixed'),
    'class': 'mr-1',
	'data-widget': 'control-sidebar-header-footer'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('layout-navbar-fixed');
	  update_setting('navbar_position_fix',1);
    } else {
      $('body').removeClass('layout-navbar-fixed');
	  update_setting('navbar_position_fix',0);
    }
  })
  var $position_navbar_fix_label = $('<label />',{'class': 'modal-checkbox'}).text('Navbar Fix').append($position_navbar_fix_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $position_navbar_fix_container = $('<div />', {'class': 'mb-1'}).append($position_navbar_fix_label)
  $container.append($position_navbar_fix_container)

	var $position_footer_fix_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('body').hasClass('layout-footer-fixed'),
    'class': 'mr-1',
	'data-widget': 'control-sidebar-header-footer'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('layout-footer-fixed');
	  update_setting('footer_position_fix',1);
    } else {
      $('body').removeClass('layout-footer-fixed');
	  update_setting('footer_position_fix',0);
    }
  })
  var $position_footer_fix_label = $('<label />',{'class': 'modal-checkbox'}).text('Footer Fix').append($position_footer_fix_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $position_footer_fix_container = $('<div />', {'class': 'mb-1'}).append($position_footer_fix_label)
  $container.append($position_footer_fix_container)

  var $text_sm_body_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('body').hasClass('text-sm'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('text-sm');
	  update_setting('body_small_text',1);
    } else {
      $('body').removeClass('text-sm');
	  update_setting('body_small_text',0);
    }
  })
  var $text_sm_body_label = $('<label />',{'class': 'modal-checkbox'}).text('Ukuran Teks Keseluruhan').append($text_sm_body_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $text_sm_body_container = $('<div />', {'class': 'mb-1'}).append($text_sm_body_label)
  $container.append($text_sm_body_container)

  var $text_sm_header_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.main-header').hasClass('text-sm'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-header').addClass('text-sm');
	  update_setting('navbar_small_text',1);
    } else {
      $('.main-header').removeClass('text-sm');
	  update_setting('navbar_small_text',0);
    }
  })
  var $text_sm_header_label = $('<label />',{'class': 'modal-checkbox'}).text('Ukuran Teks Navbar').append($text_sm_header_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $text_sm_header_container = $('<div />', {'class': 'mb-1'}).append($text_sm_header_label)
  $container.append($text_sm_header_container)

  var $text_sm_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.nav-sidebar').hasClass('text-sm'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('text-sm');
	  update_setting('sidebar_nav_small_text',1);
    } else {
      $('.nav-sidebar').removeClass('text-sm');
	  update_setting('sidebar_nav_small_text',0);
    }
  })
  var $text_sm_sidebar_label = $('<label />',{'class': 'modal-checkbox'}).text('Ukuran Teks Sidebar').append($text_sm_sidebar_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $text_sm_sidebar_container = $('<div />', {'class': 'mb-1'}).append($text_sm_sidebar_label)
  $container.append($text_sm_sidebar_container)

  var $text_sm_footer_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.main-footer').hasClass('text-sm'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-footer').addClass('text-sm');
	  update_setting('footer_small_text',1);
    } else {
      $('.main-footer').removeClass('text-sm');
	  update_setting('footer_small_text',0);
    }
  })
var $text_sm_footer_label = $('<label />',{'class': 'modal-checkbox'}).text('Ukuran Teks Footer').append($text_sm_footer_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $text_sm_footer_container = $('<div />', {'class': 'mb-1'}).append($text_sm_footer_label)
  $container.append($text_sm_footer_container)

var $mini_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('body').hasClass('sidebar-collapse'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('body').addClass('sidebar-collapse');
	  update_setting('mini_sidebar',1);
    } else {
      $('body').removeClass('sidebar-collapse');
	  update_setting('mini_sidebar',0);
    }
  })
  var $mini_sidebar_label = $('<label />',{'class': 'modal-checkbox'}).text('Sidebar Mini').append($mini_sidebar_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $mini_sidebar_container = $('<div />', {'class': 'mb-1'}).append($mini_sidebar_label)
  $container.append($mini_sidebar_container)

  var $flat_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.nav-sidebar').hasClass('nav-flat'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-flat');
	  update_setting('sidebar_nav_flat_style',1);
    } else {
      $('.nav-sidebar').removeClass('nav-flat');
	  update_setting('sidebar_nav_flat_style',0);
    }
  })
 // var $flat_sidebar_label = $('<label />',{'class': 'modal-checkbox'}).text('Sidebar Bergaya Flat').append($flat_sidebar_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $flat_sidebar_container = $('<div />', {'class': 'mb-1'}).append($('<label />',{'class': 'modal-checkbox'}).text('Sidebar Bergaya Flat').append($flat_sidebar_checkbox).append('<span class="checkboxcheckmark"></span>'));
  $container.append($flat_sidebar_container)

  var $legacy_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.nav-sidebar').hasClass('nav-legacy'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-legacy');
	  update_setting('sidebar_nav_legacy_style',1);
    } else {
      $('.nav-sidebar').removeClass('nav-legacy');
	  update_setting('sidebar_nav_legacy_style',0);
    }
  })
  var $legacy_sidebar_label = $('<label />',{'class': 'modal-checkbox'}).text('Sidebar Bergaya Legacy').append($legacy_sidebar_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $legacy_sidebar_container = $('<div />', {'class': 'mb-1'}).append($legacy_sidebar_label)
  $container.append($legacy_sidebar_container)

  var $compact_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.nav-sidebar').hasClass('nav-compact'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-compact');
	  update_setting('sidebar_nav_compact',1);
    } else {
      $('.nav-sidebar').removeClass('nav-compact');
	  update_setting('sidebar_nav_compact',0);
    }
  })
  var $compact_sidebar_label = $('<label />',{'class': 'modal-checkbox'}).text('Sidebar Berhimpit').append($compact_sidebar_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $compact_sidebar_container = $('<div />', {'class': 'mb-1'}).append($compact_sidebar_label)
  $container.append($compact_sidebar_container)

  var $child_indent_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.nav-sidebar').hasClass('nav-child-indent'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-child-indent');
	  update_setting('sidebar_nav_child_indent',1);
    } else {
      $('.nav-sidebar').removeClass('nav-child-indent');
	  update_setting('sidebar_nav_child_indent',0);
    }
  })
  var $child_indent_sidebar_label = $('<label />',{'class': 'modal-checkbox'}).text('Sidebar Level Merenggang').append($child_indent_sidebar_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $child_indent_sidebar_container = $('<div />', {'class': 'mb-1'}).append($child_indent_sidebar_label)
  $container.append($child_indent_sidebar_container)

  var $sidebar_nav_faf_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.nav-sidebar').hasClass('nav-faf-solid'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-faf-solid');
	  $('.nav-sidebar').removeClass('nav-faf-light');
	  update_setting('sidebar_nav_faf',1);
    } else {
	  $('.nav-sidebar').addClass('nav-faf-light');
      $('.nav-sidebar').removeClass('nav-faf-solid');
	  update_setting('sidebar_nav_faf',0);
    }
  })
  var $sidebar_nav_faf_label = $('<label />',{'class': 'modal-checkbox'}).text('Sidebar Level 1 Icon Solid').append($sidebar_nav_faf_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $sidebar_nav_faf_container = $('<div />', {'class': 'mb-1'}).append($sidebar_nav_faf_label)
  $container.append($sidebar_nav_faf_container)

  var $sidebar_nav_fas_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.nav-sidebar').hasClass('nav-fas-solid'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.nav-sidebar').addClass('nav-fas-solid');
	  $('.nav-sidebar').removeClass('nav-fas-light');
	  update_setting('sidebar_nav_fas',1);
    } else {
	  $('.nav-sidebar').addClass('nav-fas-light');
      $('.nav-sidebar').removeClass('nav-fas-solid');
	  update_setting('sidebar_nav_fas',0);
    }
  })
  var $sidebar_nav_fas_label = $('<label />',{'class': 'modal-checkbox'}).text('Sidebar Level 2 Icon Solid').append($sidebar_nav_fas_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $sidebar_nav_fas_container = $('<div />', {'class': 'mb-1'}).append($sidebar_nav_fas_label)
  $container.append($sidebar_nav_fas_container)

  var $no_expand_sidebar_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: !$('.main-sidebar').hasClass('sidebar-no-expand'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.main-sidebar').removeClass('sidebar-no-expand');
	  update_setting('main_sidebar_disable_hover',0);
    } else {
      $('.main-sidebar').addClass('sidebar-no-expand');
	  update_setting('main_sidebar_disable_hover',1);
    }
  })
  var $no_expand_sidebar_label = $('<label />',{'class': 'modal-checkbox'}).text('Sidebar Melebar Otomatis').append($no_expand_sidebar_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $no_expand_sidebar_container = $('<div />', {'class': 'mb-1'}).append($no_expand_sidebar_label)
  $container.append($no_expand_sidebar_container)

  var $text_sm_brand_checkbox = $('<input />', {
    type   : 'checkbox',
    value  : 1,
    checked: $('.brand-link').hasClass('text-sm'),
    'class': 'mr-1'
  }).on('click', function () {
    if ($(this).is(':checked')) {
      $('.brand-link').addClass('text-sm');
	  update_setting('brand_small_text',1);
    } else {
      $('.brand-link').removeClass('text-sm');
	  update_setting('brand_small_text',0);
    }
  })
  var $text_sm_brand_label = $('<label />',{'class': 'modal-checkbox'}).text('Ukuran Teks Brand').append($text_sm_brand_checkbox).append('<span class="checkboxcheckmark"></span>')
  var $text_sm_brand_container = $('<div />', {'class': 'mb-4'}).append($text_sm_brand_label)
  $container.append($text_sm_brand_container)
 
 $container.append('<hr class="cs-cb mb-2"/>')
  $container.append('<h6>Warna Navbar</h6>')

  var $navbar_variants        = $('<div />', {
    'class': 'd-flex'
  })
  var navbar_all_colors       = navbar_dark_skins.concat(navbar_light_skins)
	temp_class = "";
   navbar_all_colors.map(function (skin) {
      if($('.main-header').hasClass(skin))
		temp_class = skin;
    })
  var $navbar_variants_colors = createSkinBlock(navbar_all_colors, temp_class, function (e) {
    var color = $(this).data('color')
    var $main_header = $('.main-header')
    $main_header.removeClass('navbar-dark').removeClass('navbar-light')
    navbar_all_colors.map(function (color) {
      $main_header.removeClass(color)
    })
	var nav_color = '';
	
    if (navbar_dark_skins.indexOf(color) > -1) {
      $main_header.addClass('navbar-dark')
	  nav_color = 'navbar-dark ';
    } else {
      $main_header.addClass('navbar-light')
	  nav_color = 'navbar-light ';
    }

    $main_header.addClass(color);
	nav_color += color;
	update_setting('navbar_variant',nav_color);

	$(this).parent().find('i').remove();
	$(this).html("<i class='nav-icon far fa-check'></i>");
  })

  $navbar_variants.append($navbar_variants_colors)

  $container.append($navbar_variants)

  var sidebar_base_colors = [
    'bg-dark',
    'bg-light'
  ]	

  var sidebar_colors = [
    'bg-primary',
    'bg-warning',
    'bg-info',
    'bg-danger',
    'bg-success',
    'bg-indigo',
    'bg-lightblue',
    'bg-navy',
    'bg-purple',
    'bg-fuchsia',
    'bg-pink',
    'bg-maroon',
    'bg-orange',
    'bg-lime',
    'bg-teal',
    'bg-olive'
  ]

  var accent_colors = [
    'accent-primary',
    'accent-warning',
    'accent-info',
    'accent-danger',
    'accent-success',
    'accent-indigo',
    'accent-lightblue',
    'accent-navy',
    'accent-purple',
    'accent-fuchsia',
    'accent-pink',
    'accent-maroon',
    'accent-orange',
    'accent-lime',
    'accent-teal',
    'accent-olive',
	'accent-default',
  ]

  var sidebar_skins = [
    'sidebar-dark-primary',
    'sidebar-dark-warning',
    'sidebar-dark-info',
    'sidebar-dark-danger',
    'sidebar-dark-success',
    'sidebar-dark-indigo',
    'sidebar-dark-lightblue',
    'sidebar-dark-navy',
    'sidebar-dark-purple',
    'sidebar-dark-fuchsia',
    'sidebar-dark-pink',
    'sidebar-dark-maroon',
    'sidebar-dark-orange',
    'sidebar-dark-lime',
    'sidebar-dark-teal',
    'sidebar-dark-olive',
    'sidebar-light-primary',
    'sidebar-light-warning',
    'sidebar-light-info',
    'sidebar-light-danger',
    'sidebar-light-success',
    'sidebar-light-indigo',
    'sidebar-light-lightblue',
    'sidebar-light-navy',
    'sidebar-light-purple',
    'sidebar-light-fuchsia',
    'sidebar-light-pink',
    'sidebar-light-maroon',
    'sidebar-light-orange',
    'sidebar-light-lime',
    'sidebar-light-teal',
    'sidebar-light-olive'
  ]

  $container.append('<hr class="cs-cb mb-2"/>')
  $container.append('<h6>Warna Aksen</h6>')
  var $accent_variants = $('<div />', {
    'class': 'd-flex'
  })
  $container.append($accent_variants)
	
	temp_class = "";
   accent_colors.map(function (skin) {
      if($('body').hasClass(skin))
		temp_class = skin;
    })
  
  $container.append(createSkinBlock(accent_colors,temp_class, function () {
    var color         = $(this).data('color')
    var accent_class = color
    var $body      = $('body')
    accent_colors.map(function (skin) {
      $body.removeClass(skin)
    })

    $body.addClass(accent_class)
	update_setting('accent_color_variant',accent_class);
	$(this).parent().find('i').remove();
	$(this).html("<i class='nav-icon far fa-check'></i>");
  }))

  $container.append('<hr class="cs-cb mb-2"/>')
  $container.append('<h6>Tema Tampilan</h6>')
  var $sidebar_variants = $('<div />', {
    'class': 'd-flex'
  })
  $container.append($sidebar_variants)
	temp_class = "";
   sidebar_skins.map(function (skin) {
      if($('.main-sidebar').hasClass(skin)){
		if(skin.replace('sidebar-dark', '')!=skin){
			temp_class = 'bg-dark';
		}
		else{
			temp_class = 'bg-light';
		}
	  }
    })
  $container.append(createSkinBlock(sidebar_base_colors, temp_class, function () {
    var color         = $(this).data('color')
    var sidebar_class = 'sidebar-' + color.replace('bg-', '')
	var content_class = 'content-' +  color.replace('bg-', '')
    var $sidebar      = $('.main-sidebar')
	var $content     = $('body')
	$control_sidebar   = $('.control-sidebar')
    sidebar_skins.map(function (skin) {
		if($sidebar.hasClass(skin)){
			if(skin.replace('sidebar-dark', '')!=skin){
				sidebar_class += skin.replace('sidebar-dark', '');
				content_class += skin.replace('sidebar-dark', '');
			}
			else{
				sidebar_class += skin.replace('sidebar-light', '');
				content_class += skin.replace('sidebar-light', '');
			}
		}
      $sidebar.removeClass(skin)
	  $content.removeClass('content-' +  skin.replace('sidebar-', ''))
    })
    $sidebar.addClass(sidebar_class)
	$content.addClass(content_class)
	if(color=="bg-dark"){
		$control_sidebar.addClass('control-sidebar-dark')
		$control_sidebar.removeClass('control-sidebar-light')
	}else{
		$control_sidebar.addClass('control-sidebar-light')
		$control_sidebar.removeClass('control-sidebar-dark')
	}
	update_setting('sidebar_variant',sidebar_class.replace('sidebar', ''));
	$(this).parent().find('i').remove();
	$(this).html("<i class='nav-icon far fa-check'></i>");
  }))
	
  $container.append('<hr class="cs-cb mb-2"/>')
  $container.append('<h6>Warna Tombol Aktif</h6>')
  var $sidebar_button = $('<div />', {
    'class': 'd-flex'
  })
  $container.append($sidebar_button)
	temp_class = "";
   sidebar_skins.map(function (skin) {
      if($('.main-sidebar').hasClass(skin)){
		if(skin.replace('sidebar-dark', '')!=skin){
			temp_class = 'bg' + skin.replace('sidebar-dark', '');
		}
		else{
			temp_class = 'bg' + skin.replace('sidebar-light', '');
		}
	  }
    })
  $container.append(createSkinBlock(sidebar_colors,temp_class, function () {
    var color         = $(this).data('color')
    var sidebar_class =  color.replace('bg-', '')
	var content_class = color.replace('bg-', '')
    var $sidebar      = $('.main-sidebar')
	var $content     = $('body')
    sidebar_skins.map(function (skin) {
		if($sidebar.hasClass(skin)){
			if(skin.replace('sidebar-dark', '')!=skin){
				sidebar_class = 'sidebar-dark-' + sidebar_class;
				content_class = 'content-dark-' + content_class;
			}
			else{
				sidebar_class = 'sidebar-light-' + sidebar_class;
				content_class = 'content-light-' + content_class;
			}
		}
      $sidebar.removeClass(skin)
	  $content.removeClass('content-' +  skin.replace('sidebar-', ''))
    })

    $sidebar.addClass(sidebar_class)
	$content.addClass(content_class)
	update_setting('sidebar_variant',sidebar_class.replace('sidebar', ''));
	$(this).parent().find('i').remove();
	$(this).html("<i class='nav-icon far fa-check'></i>");
  }))

  var logo_skins = navbar_all_colors
  logo_skins = logo_skins.concat(['navbar-default'])
  $container.append('<hr class="cs-cb mb-2"/>')
  $container.append('<h6>Warna Logo Brand</h6>')
  var $logo_variants = $('<div />', {
    'class': 'd-flex'
  })
  $container.append($logo_variants)
	temp_class = "";
   logo_skins.map(function (skin) {
      if($('.brand-link').hasClass(skin))
		temp_class = skin;
    })
  $container.append(createSkinBlock(logo_skins, temp_class, function () {
    var color = $(this).data('color')
    var $logo = $('.brand-link')
    logo_skins.map(function (skin) {
      $logo.removeClass(skin)
    })
    $logo.addClass(color)
	update_setting('brand_logo_variant',color);
	$(this).parent().find('i').remove();
	$(this).html("<i class='nav-icon far fa-check'></i>");
  }))
	$container.append('<hr class="cs-cb mb-2"/>')
	$container.append('<hr class="cs-cb mb-2"/>')
  function createSkinBlock(colors, check, callback) {
    var $block = $('<div />', {
      'class': 'd-flex flex-wrap mb-3'
    })

    colors.map(function (color) {
      var $color = $('<div />', {
        'class': (typeof color === 'object' ? color.join(' ') : color).replace('navbar-', 'bg-').replace('accent-', 'bg-') + ' elevation-2 '
      })

      $block.append($color)

      $color.data('color', color)

      $color.css({
		'text-align' : 'center',
        width       : '40px',
        height      : '20px',
        borderRadius: '25px',
        marginRight : 10,
        marginBottom: 10,
        opacity     : 0.8,
        cursor      : 'pointer',
		'line-height': '20px'
      })

      $color.hover(function () {
        $(this).css({ opacity: 1 }).removeClass('elevation-2').addClass('elevation-4')
      }, function () {
        $(this).css({ opacity: 0.8 }).removeClass('elevation-4').addClass('elevation-2')
      })

      if (callback) {
		if(check && check==color)
			$color.html("<i class='nav-icon far fa-check'></i>").on('click', callback)
		else
			$color.on('click', callback)
      }
    })

    return $block
  }

})(jQuery)

$(document).ready(function(){
	$.ajax({ 
	   type: "POST", 
	   url: "index.php?r=employee%2Fget_setting_ajax",
	   dataType:'json',
	   success: function(dataDetailSetting){
			set_id_setting(dataDetailSetting['setting_id']);
			
	   }			   
	});
});