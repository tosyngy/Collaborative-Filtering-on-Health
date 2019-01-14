var act = 0;
var rel = 0;
    $('.next').click(function () {
          if (act === 2) {
            confirm_quest();
            result();
//        $(".sym-head").fadeOut();
//        $(".next").fadeOut();
//        $(".back").fadeOut();
            return;
        } else if (act === 1) {
            if (ass_check.length !== 0) {
                $(".sym-head").text("Which other symptoms have you not metioned");
                $(".list-item").replaceWith("<div class='list-item'>" + ass_acc + "<div>");
                act = 2;
            } else {
                confirm_quest();
                result();
            }
            return;
        }
        $('.slide.active').removeClass('active').next('.slide').addClass('active');
        var a = $('.slide.active').attr('id');
        if (!a) {
            $('.slide').first().addClass('active');
        }

        if ($('.slide.active').children().length > 12) {
            $('.slide.active').children().addClass("col-xs-4");
            $(".slide").css("padding-top", "10px");
        }
        else if ($('.slide.active').children().length > 9) {
            $('.slide.active').children().addClass("col-xs-6");
            $(".slide").css("padding-top", "10px");
        } else {
            $(".slide").css({"width": "100%"});
        }

        $('.slide.active').show();


        $('.slide.active').prev().hide();
        if ($('.slide').last().attr('id') === $('.slide.active').attr('id')) {
            act = 1;
            var sym = selected[$('.slide.active').attr('rel_')];
            $('.sym-head').text(sym);
        $('.slide.active').removeClass('active');
        }
    var sym = selected[$('.slide.active').attr('rel_')];
       $('.sym-head').text(sym);
        
        
    });

    $('.back').click(function () {
        $('.slide.active').removeClass('active').prev('.slide').addClass('active');
        $('.slide.active').show();


        $('.slide.active').next().hide();
        if ($('.slide').last().attr('id') === $('.slide.active').attr('id')) {
            $('.slide.active').removeClass('active');
        }

        var sym = selected[$('.slide.active').attr('rel_')];
        $('.sym-head').text(sym);
    });



$('#letter').click(function () {
    $('.img-switch').hide();
    $('.alpha-switch').fadeIn();
});
$('#image').click(function () {
    $('.img-switch').fadeIn();
    $('.alpha-switch').hide();
}); 