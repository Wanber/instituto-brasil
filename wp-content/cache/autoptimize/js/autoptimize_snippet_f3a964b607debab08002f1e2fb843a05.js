jQuery(document).ready(function($){if(typeof pys_fb_pixel_options==='undefined'){return;}
var options=pys_fb_pixel_options;!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';n.agent='dvpixelyoursite';n.queue=[];t=b.createElement(e);t.async=!0;t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,document,'script','https://connect.facebook.net/en_US/fbevents.js');!function setupEventHandlers(){if(options.hasOwnProperty('woo')){if(options.woo.is_product&&options.woo.add_to_cart_enabled){$(document).on('added_to_cart',function(){var params={};if(options.woo.single_product.type==='variable'){var $form=$('form.variations_form.cart'),variation_id=false,qty;if($form.length===1){variation_id=$form.find('input[name="variation_id"]').val();}
if(false===variation_id||false===options.woo.single_product.add_to_cart_params.hasOwnProperty(variation_id)){console.error('PYS PRO: product variation ID not found in available product variants.');return;}
params=clone(options.woo.single_product.add_to_cart_params[variation_id],{});qty=parseInt($form.find('input[name="quantity"]').val());params.value=params.value*qty;}else{params=clone(options.woo.single_product.add_to_cart_params,{});}
fbq('track','AddToCart',params);});}
if((options.woo.is_shop||options.woo.is_cat)&&options.woo.add_to_cart_enabled){$(document).on('adding_to_cart',function(e,$button,data){data.action='pys_fb_ajax';data.sub_action='get_woo_product_addtocart_params';$.get(options.ajax_url,data,function(response){if(!response){return;}
if(response.error){return;}
fbq('track','AddToCart',response.data);});});}}}();regularEvents();customCodeEvents();$(".ajax_add_to_cart").click(function(e){var attr=$(this).attr('data-pys-event-id');if(typeof attr=='undefined'||typeof pys_woo_ajax_events=='undefined'){return;}
evaluateEventByID(attr.toString(),pys_woo_ajax_events);});$('.edd-add-to-cart').click(function(){try{var classes=$.grep(this.className.split(" "),function(element,index){return element.indexOf('pys-event-id-')===0;});if(typeof classes=='undefined'||classes.length==0){return;}
var regexp=/pys-event-id-(.*)/;var event_id=regexp.exec(classes[0]);if(event_id==null){return;}
evaluateEventByID(event_id[1],pys_edd_ajax_events);}catch(e){console.log(e);}});function regularEvents(){if(typeof pys_events=='undefined'){return;}
for(var i=0;i<pys_events.length;i++){var eventData=pys_events[i];if(eventData.hasOwnProperty('delay')==false||eventData.delay==0){fbq(eventData.type,eventData.name,eventData.params);}else{setTimeout(function(type,name,params){fbq(type,name,params);},eventData.delay*1000,eventData.type,eventData.name,eventData.params);}}}
function customCodeEvents(){if(typeof pys_customEvents=='undefined'){return;}
$.each(pys_customEvents,function(index,code){eval(code);});}
function evaluateEventByID(eventID,events){if(typeof events=='undefined'||events.length==0){return;}
if(events.hasOwnProperty(eventID)==false){return;}
var eventData=events[eventID];if(eventData.hasOwnProperty('custom')){eval(eventData.custom);}else{fbq(eventData.type,eventData.name,eventData.params);}}
var clone=function(src,dest){for(var key in src){dest[key]=src[key];}
return dest;};});