const fileElement = document.getElementById('file');

function processFile() {
    const file = fileElement.files[0];
    file.arrayBuffer().then((file_array_buffer) => {
        const workbook = XLSX.read(file_array_buffer);
        var index = 4;
        const info_master = [];
        while (true) {
            const info = {
                ngay_thi: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'B' + index) ? workbook.Sheets["Campus TVB"]['B' + index].w : '',
                ca_thi: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'C' + index) ? workbook.Sheets["Campus TVB"]['C' + index].w : '',
                phong_thi: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'E' + index) ? workbook.Sheets["Campus TVB"]['E' + index].w : '',
                ten_mon: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'G' + index) ? workbook.Sheets["Campus TVB"]['G' + index].w : '',
                ma_mon: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'H' + index) ? workbook.Sheets["Campus TVB"]['H' + index].w : '',
                gt_1: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'O' + index) ? workbook.Sheets["Campus TVB"]['O' + index].w : '',
                gt_2: Object.prototype.hasOwnProperty.call(workbook.Sheets["Campus TVB"], 'P' + index) ? workbook.Sheets["Campus TVB"]['P' + index].w : '',
            }

            if (info.ngay_thi === '' || info.ngay_thi.length === 0) {
                break;
            }
            info_master.push(info);

            index++

        }

        console.log(info_master);
        return info_master;
        // console.log(workbook.Sheets["Campus TVB"]['G1373'].w);
        // Object.keys(workbook.Sheets["Campus TVB"]).forEach((key) => {
        //     if (!key.includes('!') && workbook.Sheets["Campus TVB"][key].w) {
        //         const str_target = workbook.Sheets["Campus TVB"][key].w.trim().replaceAll('  ', ' ');
        //         console.log(str_target);
        //     }

        // });
    });
}