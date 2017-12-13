var accessToken ="c5ec68e1d7ec49868ce55ec2754bf4cd";
var baseUrl = "https://api.api.ai/v1/";
$(document).ready(function() {
    $("#input").keypress(function(event) {
        if (event.which == 13) {
            event.preventDefault();
            send();
this.value = '';
        }
    });
    $("#rec").click(function(event) {
        switchRecognition();
    });
});
var recognition;
function startRecognition() {
    recognition = new webkitSpeechRecognition();
    recognition.onstart = function(event) {
        updateRec();
    };
    recognition.onresult = function(event) {
        var text = "";
        for (var i = event.resultIndex; i < event.results.length; ++i) {
            text += event.results[i][0].transcript;
        }
        setInput(text);
        stopRecognition();
    };
    recognition.onend = function() {
        stopRecognition();
    };
    recognition.lang = "fr-FR";
    recognition.start();
}
function stopRecognition() {
    if (recognition) {
        recognition.stop();
        recognition = null;
    }
    updateRec();
}
function switchRecognition() {
    if (recognition) {
        stopRecognition();
    } else {
        startRecognition();
    }
}
function setInput(text) {
    $("#input").val(text);
    send();
}
function updateRec() {
    $("#rec").text(recognition ? "Stop" : "Parlez");
}
function send() {
    var text = $("#input").val();
    conversation.push("Moi: " + text + '\r\n');
    $.ajax({
    type: "POST",
    url: baseUrl + "query?v=20150910",
    contentType: "application/json; charset=utf-8",
    dataType: "json",
    headers: {
    "Authorization": "Bearer " + accessToken
    },
    data: JSON.stringify({ query: text, lang: "fr", sessionId: "somerandomthing" }),
    success: function(data) {
    var respText = data.result.fulfillment.speech;
    console.log("Respuesta: " + respText);
    setResponse(respText);
    responsiveVoice.speak(respText);
    },
    error: function() {
    setResponse("Internal Server Error");
    }
    });
    //setResponse("Thinking...");
    }
    function setResponse(val) {
    conversation.push("AI: " + val + '\r\n');
    //$("#response").text(val);
    $("#response").text(conversation.join(""));
    }
function setResponse(val) {
  //Edit "AI: " to change name
    conversation.push("Google: " + val + '\r\n');
    $("#response").text(conversation.join(""));
}
var conversation = [];