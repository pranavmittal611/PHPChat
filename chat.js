//background: linear-gradient(120deg, #17bebb, #f0a6ca);
//Beautiful theme
//LONGPOLL
function curtime(){
  function pad(stri){
    return ('0'+String(stri)).slice(-2);
  }
  var curTime = new Date();
  curTime = curTime.getFullYear()+'-'+pad(curTime.getMonth()+1)+'-'+pad(curTime.getDate())+' '+pad(curTime.getHours())+':'+pad(curTime.getMinutes());
  return curTime;
}

function escapeHtml(text) {
  var map = {
    '&': '&amp;',
    '<': '&lt;',
    '>': '&gt;',
    '"': '&quot;',
    "'": '&#039;'
  };
  var repl = function(m) { return map[m]; };
  return text.replace(/[&<>"']/g, repl);
}

function fetchNew(){
  $.ajax({
    type: "POST",
    url: "chat.php",
    data: 'aid='+aid,
    async: true, /*If set to non-async, browser shows page as loading*/
    cache: false,
    timeout:42000,
    error: function(){
      setTimeout(fetchNew, 3300);
    },
    success: function(data) {
      data = JSON.parse(data);
      for (var i of data){
        var msg = escapeHtml(i[1]).replace(/\r\n|\r|\n/g,"<br>");
        $('.chatbox').append(`<div class='chatMsg admsg'><div id='userName'>Admin<div class='time'>${i[2].slice(0, -3)}</div></div><div class='message'>${msg}</div></div>`);
        aid = i[0]
      }
      $(".chatbox").scrollTop($(".chatbox")[0].scrollHeight);
      setTimeout(fetchNew, 3300);
    }
  });
}

function sendMsg() {
  var rawmsg = $("textarea.input").val().trim();
  $("form")[0].reset();
  var msg = escapeHtml(rawmsg).replace(/\r\n|\r|\n/g,"<br>");
  //Show greyed message here, make it bright on success
  var dataString = 'msg='+encodeURIComponent(rawmsg);
  $.ajax({
    type: "POST",
    url: "chat.php",
    data: dataString,
    success: function() {
      if (msg.length){
        $('.chatbox').append(`<div class='chatMsg'><div id='userName'>${unm}<div class='time'>${curtime()}</div></div><div class='message'>${msg}</div></div>`);
        $(".chatbox").scrollTop($(".chatbox")[0].scrollHeight);
      }
    }
  });
}

var unm = $("input#unm").val();
var aid = 0;

$(function() {
  $("#send-btn").click(function() {
    sendMsg();
    return false;
  });
  
  $("textarea").keypress(function (e) {
    if(e.which == 13 && !e.shiftKey) {
      sendMsg();
      return false;
      e.preventDefault();
    }
  });

  $.ajax({
    type: "POST",
    url: "chat.php",
    data: 'init',
    success: function(data) {
      var data = JSON.parse(data);
      for (var i of data){
        var msg = escapeHtml(i[2]).replace(/\r\n|\r|\n/g,"<br>");
        if (i[1]=='1'){
          $('.chatbox').append(`<div class='chatMsg'><div id='userName'>${unm}<div class='time'>${i[3].slice(0, -3)}</div></div><div class='message'>${msg}</div></div>`);
        }
        else if (i[1]=='0'){
          $('.chatbox').append(`<div class='chatMsg admsg'><div id='userName'>Admin<div class='time'>${i[3].slice(0, -3)}</div></div><div class='message'>${msg}</div></div>`);
          aid = i[0];
        }
      }
      $(".chatbox").scrollTop($(".chatbox")[0].scrollHeight);
    }
  });

  setTimeout(fetchNew, 1230);

});

/*
jQuery/JavaScript – Will handle the client side stuff. This is an AJAX-y application, meaning that messages pop onto the screen (both yours and others) without needing any page refresh.
-Periodically asking the server if there are new messages that have been posted
-Appending new messages to the chat
-Scrolling the chat down to the most recent messages
-Handling special characters and encoding-decoding the input
-Limiting the text input to prevent gigantic ridiculous messages (1001 chars, PHP)
-Basic security
-Reverse Infinite Scroll (Show earlier messages)
*/
//escapeHtml before showing ajax fetched msg
//change enter key behaviour on mobile
//autoscroll not working on mobile