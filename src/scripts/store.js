$(document).ready(function() {
	var favs_wrap = $('#favourites .collection-list'),
			cat_wrap = $('#category .collection-list');

	$('#newsletter > form').on('submit', function(e) {
		e.preventDefault();
		var form = $(this),
			button = form.find('button');
			
		button.html('Joining&hellip;');
		
		var data = {},
        apps = [];
    
    $.each(form.find('[name="apps[]"]'), function(i,item) {
      apps.push(item.value);
    })
		
		var data = {
      'apps': apps.join(','),
      'email_address': form.find('[name="email_address"]').attr('value'),
      'name': '',
      '_method': 'PUT'
    }

		$.ajax({
			type: "GET",
			url: form.attr('action'),
			data: data,
			success: function(request) {
				var msg = form.attr('data-success-message') ? form.attr('data-success-message') : 'Thanks for subscribing!';
				form.find('li').fadeOut(function() {
					$(this).html('<li class="success">'+msg+'</li>').fadeIn();
				});
			},
			error: function(request,status,error) {
				button.html('Join');
				alert('Sorry, there was an error whilst trying to subscribe you to the Newsletter. Please try again later.');
			}
		});
		
	});

	/* This is basic - uses default settings */
	$("a.zoom").fancybox({
		'transitionIn'	: 'elastic',
		'transitionOut'	: 'elastic',
		overlayOpacity : 0.3,
		overlayColor : '#000',
	});
	
	if (favs_wrap.length) {
		var list_items = favs_wrap.find('li');
		var attrs = {
			selector          : favs_wrap,
			items             : list_items,
			single_item_width : $(list_items[0]).outerWidth( true ),
			nav_items         : list_items.length / 4,
			col_width         : $(list_items[0]).outerWidth( true ) * 4
		}
		
		favs.init(attrs);
	}

	if (cat_wrap.length) {
		var list_items = cat_wrap.find('li');
		var attrs = {
			selector          : cat_wrap,
			items             : list_items,
			single_item_width : $(list_items[0]).outerWidth( true ),
			nav_items         : list_items.length / 4,
			col_width         : $(list_items[0]).outerWidth( true ) * 4
		}
		
		favs.init(attrs);

		list_items.find('a').on("click", function (e) {
			e.preventDefault();
			var el = this;

			$.ajax({
					url: el.href,
					type: 'get',
					success: function(data) {
						console.log(data.html);
						$("#product-info").html( $.trim(data.html) ).find("a.zoom").each(function (i,item) {
							$(item).fancybox({
								'transitionIn'	: 'elastic',
								'transitionOut'	: 'elastic',
								overlayOpacity : 0.3,
								overlayColor : '#000',
							});
						});
					}
				});
		})
	}
});

var favs = {};
(function() {
	this.atrributes = {
	};
	
	this.init = function(attrs) {
		this.attributes = attrs;
		this.attributes.selector.width( (attrs.single_item_width * attrs.items.length) );
		this.createNav();
		this.timer = setTimeout(function() {
			favs.scroll()
		}, 5000);
	};
	
	this.createNav = function() {
		var attrs = this.attributes;
		
		this.attributes.nav = $('<ul>').attr({
			'class' : 'pagination'
		}).appendTo(attrs.selector.prev());
		
		for(i=0; i < attrs.nav_items; i++) {
			$('<li>').attr({
				'data-marginLeft' : (attrs.col_width * i),
				'class' : (i===0 ? 'current' : '')
			})
			.text(i+1)
			.click(function() {
				clearTimeout(favs.timer);
				favs.animate($(this));
			})
			.appendTo(attrs.selector.prev().find('ul'));
		}
	};
	
	this.scroll = function() {
		var nav = this.attributes.nav,
			current = nav.find('.current'),
			next = current.next(),
			item = "";
		
		if (next.length) {
			item = next;
		} else {
			item = current.prev().prev();
		}
		
		this.animate(item);
	};
	
	this.animate = function(item) {
		var margin = parseInt(item.attr('data-marginLeft'))
		item.addClass('current').siblings().removeClass('current');
				
		if (Modernizr.testAllProps('transform')) {
			this.attributes.selector.css({
				'-webkit-transform': 'translateX(-'+margin+'px)',
				'-moz-transform': 'translateX(-'+margin+'px)',
				'-ms-transform': 'translateX(-'+margin+'px)',
				'transform': 'translateX(-'+margin+'px)'
			});
		} else {
			this.attributes.selector.css({marginLeft:'-'+margin+'px'});
		}
		
		this.timer = setTimeout(function() {
			favs.scroll()
		}, 5000);
	};
	
}).apply(favs);