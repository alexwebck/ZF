$(function() {
    ships = new Array('ship1', 'ship2', 'ship3', 'ship4');
    cells = {};
    
    shipSizeH = $('.ship1 > div').height();
    shipSizeW = $('.ship1 > div').width();  
    
    tableMaxX = $('.seaFight').width();
    tableMaxY = $('.seaFight').height();  
    
    oneCellX = $('.seaFight tr#n .x0').width();
    oneCellY =  $('.seaFight tr#n .x0').height();
    
    tableX = $('.seaFight').offset().left + oneCellX;
    tableY = $('.seaFight').offset().top + oneCellY;
    
    $('#start').click(function() {
        $.ajax({
            url: "/Seafight/add",
            type: 'POST',
            data: { cells: cells, username: $("#nameField").val() }
        }).done(function() {
        });
    });
    $(".ships > div").mouseup(function (event) {
        //net(event);
        var elementX = $(this).offset().left - tableX;
        var elementY = $(this).offset().top - tableY;
        var count = $(this).children().length;
        var xCoord = Math.ceil(elementX/oneCellX);
        var yCoord = Math.ceil(elementY/oneCellY);
        for(i in ships) {
            if($(this).hasClass(ships[i])) {
                thisShip = ships[i];
                break;
            }
        }

        var res = '';
        if($(this).hasClass('vertical')) {
            for(i = 1; i <= count; i++) {
                res += 'y' + yCoord++;
            }
            cells[thisShip] = {x: 'x' + xCoord, y: res};
        } else {
            for(i=1; i<=count; i++) {
                res += 'x' + xCoord++;
            }
            cells[thisShip] = {x: res, y: 'y' + yCoord};
        }
    });
    
  //  gridTable();
    
    $(".ships > div").draggable({ 
        start: function(event, ui) {
        $(this).draggable( "option", "cursorAt", 
            {left: Math.floor($(this).width() / 2), top: shipSizeH / 2} ); 
        },
        snap: ".seaFight td"
    });
    
    $(".ships > div").dblclick(function () {
        $(this).toggleClass('vertical');
    });
    
//    $("#ships > div").mousedown(function(event) {
//        net(event);
//        $(this).mousemove(function(event) {
//            if( elementX <= tableMaxX && elementX >=0 && elementY <= tableMaxY && elementY >=0) 
//            {
//                
//            }
//        });
//    });  
//    
//    $("#ships > div").mouseup(function (event) {
//        net(event);
//    });
//    
});

//function gridTable() {
//    var countX = Math.floor((tableMaxX - oneCellX) / oneCellX);
//    var countY = Math.floor((tableMaxY - oneCellY) / oneCellY);
//    var width = 0;
//    var height = 0;
//    gridTableArrray = new Array();
//    for(i=1; i<=countX; i++) {
//        
//        width = width + oneCellX;
//        height = height + oneCellY;
//        gridTableArrray['min_'+height+'max_'] = '';
//    }
//}


function net(event) {     
    clientX= event.clientX;
    clientY= event.clientY;
    
    elementX = clientX - tableX;
    elementY = clientY - tableY;   
}