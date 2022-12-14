let errorAfterInput = [];

function setErrorAfterInput(error, element) {
    // get element after input
    let after = $(element).next();
    if (after.length == 0) $(element).after('<div></div>');
    if (after.length == 0) after = $(element).next();

    // highlight
    $(element).addClass("is-invalid").removeClass("is-valid");
    let errors = Array.isArray(error) ? '' : `<li class="text-danger">${error}</li>`;
    if (Array.isArray(error)) {
        error.forEach(err => {
            errors += `<li class="text-danger">${err}</li>`;
        });
    }

    after.html(`<div><ul style="padding-left: 20px;">${errors}</ul></div>`);
}

function resetErrorAfterInput() {
    errorAfterInput.forEach(id => {
        // get element after input
        const element = $(`#${id}`);
        let after = $(element).next();
        if (after.length == 0) $(element).after('<div></div>');
        if (after.length == 0) after = $(element).next();
        $(element).addClass("is-valid").removeClass("is-invalid");
        after.html('');
    });
}

function setBtnLoading(element, text, status = true) {
    const el = $(element);
    if (status) {
        el.attr("disabled", "");
        el.html(
            `<span class="spinner-border spinner-border-sm mr-1" role="status" aria-hidden="true">
                                </span> <span>${text}</span>`
        );
    } else {
        el.removeAttr("disabled");
        el.html(text);
    }
}

function setToast(
    message = 'Hello, world! This is a toast message.',
    classAttr = ['text-white', 'bg-light']
) {
    var myToastEl = document.getElementById('toast');
    const toastJq = $(myToastEl);
    classAttr.forEach(element => {
        toastJq.addClass(element);
    });
    $("#toast-body").html(message);

    const delay = toastJq.attr('data-bs-delay');

    myToastEl.addEventListener('hidden.bs.toast', function () {
        toastJq.attr("class", "toast fade hide");
    });
    let counter = 0;
    const iterator = delay / 50;
    const progressbar = setInterval(() => {
        counter += iterator;
        const percent = Math.floor((50 / (delay * 0.50)) * counter);
        const progres_bar = $('#toast-progresbar');
        progres_bar.attr('style', `width: ${percent}%`);

        if (counter >= delay) {
            clearInterval(progressbar);
        }
    }, iterator);

    $('.toast').toast('show');
}

function youtube_parser(url) {
    var regExp =
        /^https?\:\/\/(?:www\.youtube(?:\-nocookie)?\.com\/|m\.youtube\.com\/|youtube\.com\/)?(?:ytscreeningroom\?vi?=|youtu\.be\/|vi?\/|user\/.+\/u\/\w{1,2}\/|embed\/|watch\?(?:.*\&)?vi?=|\&vi?=|\?(?:.*\&)?vi?=)([^#\&\?\n\/<>"']*)/i;
    var match = url.match(regExp);
    return (match && match[1].length == 11) ? match[1] : false;
}

function format_rupiah(angka, format = 2, prefix) {
    angka = angka != "" ? angka : 0;
    angka = parseFloat(angka);
    const minus = angka < 0 ? "-" : "";
    angka = angka.toString().split('.');
    let suffix = angka[1] ? '.' + angka[1] : '';

    if (format) {
        let str = '';
        for (let i = 0; i <= format; i++) {
            const suffix_1 = suffix[i] ? suffix[i] : '';
            str = `${str}${suffix_1}`;
        }
        suffix = str;
    }

    angka = angka[0];
    if (angka) {
        let number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi)

        // tambahkan titik jika yang di input sudah menjadi angka ribuan
        if (ribuan) {
            separator = sisa ? '.' : ''
            rupiah += separator + ribuan.join('.')
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah

        // return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '')
        const result = prefix == undefined ? rupiah : (rupiah ? '' + rupiah : '');
        return minus + result + suffix;
    }
    else {
        return 0
    }
}

function terbilang(nilai) {
    var prefix = "";
    if (nilai < 0) {
        nilai = Math.abs(nilai);
        prefix = "Minus "
    }
    var bilangan = `${nilai}`;
    var kalimat = ""
    var angka = new Array('0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0', '0')
    var kata = new Array('', 'Satu', 'Dua', 'Tiga', 'Empat', 'Lima', 'Enam', 'Tujuh', 'Delapan', 'Sembilan')
    var tingkat = new Array('', 'Ribu', 'Juta', 'Milyar', 'Triliun')
    var panjang_bilangan = bilangan.length

    // panjang_bilangan = 14
    /* pengujian panjang bilangan */
    if (panjang_bilangan > 15) {
        kalimat = "Diluar Batas"
    }
    else {
        /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
        for (i = 1; i <= panjang_bilangan; i++) {
            angka[i] = bilangan.substr(-(i), 1)
        }

        var i = 1
        var j = 0

        /* mulai proses iterasi terhadap array angka */
        while (i <= panjang_bilangan) {
            subkalimat = ""
            kata1 = ""
            kata2 = ""
            kata3 = ""

            /* untuk Ratusan */
            if (angka[i + 2] != "0") {
                if (angka[i + 2] == "1") {
                    kata1 = "Seratus"
                }
                else {
                    kata1 = kata[angka[i + 2]] + " Ratus"
                }
            }

            /* untuk Puluhan atau Belasan */
            if (angka[i + 1] != "0") {
                if (angka[i + 1] == "1") {
                    if (angka[i] == "0") {
                        kata2 = "Sepuluh"
                    }
                    else if (angka[i] == "1") {
                        kata2 = "Sebelas"
                    }
                    else {
                        kata2 = kata[angka[i]] + " Belas"
                    }
                }
                else {
                    kata2 = kata[angka[i + 1]] + " Puluh"
                }
            }

            /* untuk Satuan */
            if (angka[i] != "0") {
                if (angka[i + 1] != "1") {
                    kata3 = kata[angka[i]]
                }
            }

            /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
            if ((angka[i] != "0") || (angka[i + 1] != "0") || (angka[i + 2] != "0")) {
                subkalimat = kata1 + " " + kata2 + " " + kata3 + " " + tingkat[j] + " "
            }

            /* gabungkan variabe sub kalimat (untuk Satu blok 3 angka) ke variabel kalimat */
            kalimat = subkalimat + kalimat
            i = i + 3
            j = j + 1
        }

        /* mengganti Satu Ribu jadi Seribu jika diperlukan */
        if ((angka[5] == "0") && (angka[6] == "0")) {
            kalimat = kalimat.replace("Satu Ribu", "Seribu")
        }
    }

    return prefix + kalimat.trim();
}


function renderDataTable(element_table) {
    const tableUser = $(element_table).DataTable({
        columnDefs: [{
            orderable: false,
            targets: [0]
        }],
        // responsive: true,
        scrollX: true,
        // aAutoWidth: true,
        // bAutoWidth: true,
        order: [
            [0, 'asc']
        ]
    });
    tableUser.on('draw.dt', function () {
        var PageInfo = $(element_table).DataTable().page.info();
        tableUser.column(0, {
            page: 'current'
        }).nodes().each(function (cell, i) {
            cell.innerHTML = i + 1 + PageInfo.start;
        });
    });
}

function format_tanggal(tanggal_input) {
    var date = new Date(tanggal_input);
    var tahun = date.getFullYear();
    var bulan = date.getMonth();
    var tanggal = date.getDate();
    var hari = date.getDay();
    var jam = date.getHours();
    var menit = date.getMinutes();
    var detik = date.getSeconds();
    switch (hari) {
        case 0: hari = "Minggu"; break;
        case 1: hari = "Senin"; break;
        case 2: hari = "Selasa"; break;
        case 3: hari = "Rabu"; break;
        case 4: hari = "Kamis"; break;
        case 5: hari = "Jum'at"; break;
        case 6: hari = "Sabtu"; break;
    }
    switch (bulan) {
        case 0: bulan = "Januari"; break;
        case 1: bulan = "Februari"; break;
        case 2: bulan = "Maret"; break;
        case 3: bulan = "April"; break;
        case 4: bulan = "Mei"; break;
        case 5: bulan = "Juni"; break;
        case 6: bulan = "Juli"; break;
        case 7: bulan = "Agustus"; break;
        case 8: bulan = "September"; break;
        case 9: bulan = "Oktober"; break;
        case 10: bulan = "November"; break;
        case 11: bulan = "Desember"; break;
    }

    const tanggal_str = (hari) ? (hari + " " + tanggal + " " + bulan + " " + tahun) : '';
    const waktu = jam + ":" + menit + ":" + detik;
    return {
        tanggal: tanggal_str,
        waktu
    }
}

function render_tanggal(e) {
    const tanggal = format_tanggal($(e).val()).tanggal;
    if ($(e).next().is('small')) {
        $(e).next().html(tanggal);
    } else {
        $(`<small>${tanggal}</small>`).insertAfter(e);
    }
}

function colorClass(number) {
    if (number == 0) return 'warning';
    else if (number == 1) return 'info';
    else if (number == 2) return 'secondary';
    else if (number == 3) return 'primary';
    else if (number == 4) return 'success';
    else return 'danger';
}

function statusPengamblian(status) {
    if (status == 0) return 'Data Dibuat';
    else if (status == 4) return 'Pengembalian Selesai';
    else if (status == 3) return 'Pengembalian Disimpan';
    else if (status == 2) return 'Barang Dikirim';
    else if (status == 1) return 'Data Disimpan';
    else return 'Data Dibuat';
}

function parse_tanggal_waktu_str(data) {
    const tanggal = String(data).split(" ");
    return `${tanggal[0]}<br><small>${tanggal[1]}</small>`;
}

function tooltip_refresh() {
    $('[data-toggle="tooltip"]').tooltip();
}