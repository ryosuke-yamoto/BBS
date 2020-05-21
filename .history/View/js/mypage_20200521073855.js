$(function () {
  
  $("#name-change").click(function () {
    $("#modal").show();
    $("#modal-title").text("新しい名前を入力してください");
    $("#change-button").attr("name", "name_change");
  });

  $("#mail-change").click(function () {
    $("#modal").show();
    // $("#modal-title").text("新しい名前を入力してください");
    // $("#change-button").attr("name", "name_change");
  });

  $(".back-button").click(function () {
    $("#modal").hide();
    $("#modal-title").text("");
    $("#change-button").attr("name", "");
  });
  
  });