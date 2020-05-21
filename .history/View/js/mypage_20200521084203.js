$(function () {
  
  $("#name-change").click(function () {
    $("#modal").show();
    $("#modal-title").text("新しい名前を入力してください");
    $("#change-input").attr("name", "name_change");
  });

  $("#mail-change").click(function () {
    $("#modal").show();
    $("#modal-title").text("新しいメールアドレスを入力してください");
    $("#change-input").attr("name", "mail_change");
  });

  $(".back-button").click(function () {
    $("#modal").hide();
    $("#modal-title").text("");
    $("#change-input").attr("name", "");
  });
  
  });