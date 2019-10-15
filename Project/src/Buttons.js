import $ from 'jquery';
import {parse_json} from "./parse_json";

export const Buttons = function(sel) {
    var that = this;

    $('input:submit, button').click(function(event){
        event.preventDefault();
        that.move(this,sel);
        console.log('worked');
    });
}

Buttons.prototype.move = function(button,sel){
    var that = this;

    var form = $(sel);
    var serialized = form.serialize();

    if(serialized ==="")
    {
        serialized = {};
        serialized[$(button).attr('name')] = [$(button).attr('value')];
    }

    $.ajax({
        url: "game-post.php",
        data: serialized,
        method: "POST",
        success: function(data){
            var json = parse_json(data);

            var board = json['board'];
            var menu = json['menu'];
            that.presentGame(board,menu,sel);
        }

    });
}

Buttons.prototype.presentGame = function(board, menu, sel){
    $(".game").html(board+menu);
    new Buttons(sel);
}
