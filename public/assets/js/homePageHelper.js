//add click listener to submit button
setTimeout(function(){
    $('.btn#confirm-select').on('click', function() {
        selectBuild();
    });
    $('.btn#create-build').on('click', function() {
        createBuild();
    });
    $('.btn#save-build').on('click', function() {
        saveBuild();
    });
    $('#items-1').change(function() {
        if ($(".motherboard").length) {
            setProcessor();   
        }
    });
    $('#items-2').change(function() {
        if ($(".motherboard").length) {
            setRAM();   
        }
    });
    $('#items-3').change(function() {
        if ($(".motherboard").length) {
            setGFX();   
        }
    });
    $('#items-4').change(function() {
        if ($(".motherboard").length) {
            setFan();   
        }
    });
    $('#items-5').change(function() {
        if ($(".motherboard").length) {
            setPower();   
        }
    });
}, 0);

function setProcessor() {
    var id = document.getElementById("items-1").value;
    $.ajax({
       type: "POST",
       url: "/home/setImage/" + id,
       success:function(data) {
           if (data === "") {
               $(".cpu-img").hide();
               $(".cpu-img").attr('src',data);
           } else {
               $(".cpu-img").show();
               $(".cpu-img").attr('src',data);
           }
       }
    });
}

function setRAM() {
    var id = document.getElementById("items-2").value;
    $.ajax({
       type: "POST",
       url: "/home/setImage/" + id,
       success:function(data) {
           if (data === "") {
               $(".memory-img").hide();
               $(".memory-img").attr('src',data);
           } else {
               $(".memory-img").show();
               $(".memory-img").attr('src',data);
           }
       }
    });
}

function setGFX() {
    var id = document.getElementById("items-3").value;
    $.ajax({
       type: "POST",
       url: "/home/setImage/" + id,
       success:function(data) {
           if (data === "") {
               $(".gpu-img").hide();
               $(".gpu-img").attr('src',data);
           } else {
               $(".gpu-img").show();
               $(".gpu-img").attr('src',data);
           }
       }
    });
}

function setFan() {
    var id = document.getElementById("items-4").value;
    $.ajax({
       type: "POST",
       url: "/home/setImage/" + id,
       success:function(data) {
           if (data === "") {
               $(".cooler-img").hide();
               $(".cooler-img").attr('src',data);
           } else {
               $(".cooler-img").show();
               $(".cooler-img").attr('src',data);
           }
       }
    });
}

function setPower() {
    var id = document.getElementById("items-5").value;
    $.ajax({
       type: "POST",
       url: "/home/setImage/" + id,
       success:function(data) {
           if (data === "") {
               $(".psu-img").hide();
               $(".psu-img").attr('src',data);
           } else {
               $(".psu-img").show();
               $(".psu-img").attr('src',data);
           }
       }
    });
}

//Creates a new build with specified name
function createBuild() {
    var name = $('#create-build-name').val();
    $.ajax({
       type: "POST",
       url: "/home/createBuild/" + name
    });
}

function saveBuild() {
    var setId = document.getElementById("selectBuildID").value;
    var cpuId = document.getElementById("items-1").value;
    var ramId = document.getElementById("items-2").value;
    var gpuId = document.getElementById("items-3").value;
    var fanId = document.getElementById("items-4").value;
    var psuId = document.getElementById("items-5").value;
    if (cpuId == "") {
        cpuId = -1;
    }
    if (ramId == "") {
        ramId = -1;
    }
    if (gpuId == "") {
        gpuId = -1;
    }
    if (fanId == "") {
        fanId = -1;
    }
    if (psuId == "") {
        psuId = -1;
    }
    $.ajax({
       type: "POST",
       url: "/home/saveBuild/"
               + setId + "/"
               + cpuId + "/"
               + ramId + "/"
               + gpuId + "/"
               + fanId + "/"
               + psuId,
       success:function(data) {
           alert(data);
       }
    });
}

//attach image to picture box div
function selectBuild() {
    var id = $('#selectBuildID').val();
    $.ajax({
        type: "POST",
        url:  "/home/selectBuild/" + id,
        //data: {id : id},
        success:function(data) {
            console.log(typeof(data));
            console.log(data);
            if (data == null || data == undefined || data == '') {
                    console.log('there is no data');
            }
            $('.picture-box').html(data);
            
            if ($('.cpu-img').attr('src') === '') {
                $('.cpu-img').hide();
            }
            if ($('.memory-img').attr('src') === '') {
                $('.memory-img').hide();
            }
            if ($('.gpu-img').attr('src') === '') {
                $('.gpu-img').hide();
            }
            if ($('.cooler-img').attr('src') === '') {
                $('.cooler-img').hide();
            }
            if ($('.psu-img').attr('src') === '') {
                $('.psu-img').hide();
            }
        }
    });
}