const fileElement = document.getElementById("file");
function procarFile() {
  const file = fileElement.files[0];
  file.arrayBuffer().then((file_array_buffer) => {
    const workbook = XLSX.read(file_array_buffer);
    var index = 4;
    const info_master = [];
    while (true) {
      const info = {
        ten_mon: Object.prototype.hasOwnProperty.call(
          workbook.Sheets["Campus TVB"],
          "G" + index
        )
          ? workbook.Sheets["Campus TVB"]["G" + index].w
          : "",
        ma_mon: Object.prototype.hasOwnProperty.call(
          workbook.Sheets["Campus TVB"],
          "H" + index
        )
          ? workbook.Sheets["Campus TVB"]["H" + index].w
          : "",
      };
      if (info.ma_mon === "" || info.ma_mon.length === 0) {
        break;
      }
      info_master.push(info);

      index++;
    }
    fetch(
      "http://localhost/MvcDemomohinh/MvcDemomohinh/?role=admin&mod=subject&action=create",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(info_master),
      }
    )
      .then((res) => {
        return res.json();
      })
      .then((responseData) => {
        if (responseData.status === "success") {
          alert(responseData.message);
        } else {
          // Phản hồi lỗi
          alert("Error: " + responseData.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });
  });

  event.preventDefault();
}

function processFile() {
  const file = fileElement.files[0];
  file.arrayBuffer().then((file_array_buffer) => {
    const workbook = XLSX.read(file_array_buffer);
    var index = 4;
    const info_master = [];
    while (true) {
      const info = {
        ngay_thi: Object.prototype.hasOwnProperty.call(
          workbook.Sheets["Campus TVB"],
          "B" + index
        )
          ? workbook.Sheets["Campus TVB"]["B" + index].w
          : "",
        ca_thi: Object.prototype.hasOwnProperty.call(
          workbook.Sheets["Campus TVB"],
          "C" + index
        )
          ? workbook.Sheets["Campus TVB"]["C" + index].w
          : "",
        phong_thi: Object.prototype.hasOwnProperty.call(
          workbook.Sheets["Campus TVB"],
          "E" + index
        )
          ? workbook.Sheets["Campus TVB"]["E" + index].w
          : "",
        ten_mon: Object.prototype.hasOwnProperty.call(
          workbook.Sheets["Campus TVB"],
          "G" + index
        )
          ? workbook.Sheets["Campus TVB"]["G" + index].w
          : "",
        ma_mon: Object.prototype.hasOwnProperty.call(
          workbook.Sheets["Campus TVB"],
          "H" + index
        )
          ? workbook.Sheets["Campus TVB"]["H" + index].w
          : "",
        lop: Object.prototype.hasOwnProperty.call(
          workbook.Sheets["Campus TVB"],
          "L" + index
        )
          ? workbook.Sheets["Campus TVB"]["L" + index].w
          : "",
        gt_1: Object.prototype.hasOwnProperty.call(
          workbook.Sheets["Campus TVB"],
          "O" + index
        )
          ? workbook.Sheets["Campus TVB"]["O" + index].w
          : "",
        gt_2: Object.prototype.hasOwnProperty.call(
          workbook.Sheets["Campus TVB"],
          "P" + index
        )
          ? workbook.Sheets["Campus TVB"]["P" + index].w
          : "",
      };

      if (info.ngay_thi === "" || info.ngay_thi.length === 0) {
        break;
      }
      info_master.push(info);

      index++;
    }
    fetch(
      "http://localhost/MvcDemomohinh/MvcDemomohinh/?role=admin&mod=upload_file",
      {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(info_master),
      }
    )
      .then((res) => {
        return res.json();
      })
      .then((responseData) => {
        if (responseData.status === "success") {
          alert(responseData.message);
        } else {
          // Phản hồi lỗi
          alert("Error: " + responseData.message);
        }
      })
      .catch((error) => {
        console.error("Error:", error);
      });

    // console.log(workbook.Sheets["Campus TVB"]['G1373'].w);
    // Object.keys(workbook.Sheets["Campus TVB"]).forEach((key) => {
    //     if (!key.includes('!') && workbook.Sheets["Campus TVB"][key].w) {
    //         const str_target = workbook.Sheets["Campus TVB"][key].w.trim().replaceAll('  ', ' ');
    //         console.log(str_target);
    //     }

    // });
  });

  event.preventDefault();
}

// Append input file
var addFile = document.getElementById("add-file");
var i = 1;
function appendInput() {
  var input = document.createElement("input");
  input.multiple = true;
  input.type = "File";
  input.name = "file_exam".concat("[]");
  input.id = "file";
  input.className = "form-control";

  addFile.appendChild(input);
}
