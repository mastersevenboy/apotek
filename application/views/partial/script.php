    
    <!-- Bootstrap core JavaScript-->
    <script src="<?php echo base_url('assets/admin/') ;?>vendor/jquery/jquery.min.js"></script>
	<script src="<?php echo base_url('assets/admin/') ;?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="<?php echo base_url('assets/admin/') ;?>vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="<?php echo base_url('assets/admin/') ;?>js/sb-admin-2.min.js"></script>

    <script>
        $('.btn-ubah-sup').on('click', function (e) {
            e.preventDefault();
            let id_sp = $(this).data('id');
            $('#ubahModal').modal('show');
            $.ajax({
                url: `supplier/getAjax/${id_sp}`,
                method: 'POST',
                dataType: 'JSON',
                success: function (data) {
                    const {id_sp, nama_sp, alamat, kota, telp} = data;
                    $('#ubahModal #id_sp').val(id_sp);
                    $('#ubahModal #nama_sp').val(nama_sp);
                    $('#ubahModal #alamat').val(alamat);
                    $('#ubahModal #kota').val(kota);
                    $('#ubahModal #telp').val(telp);
                }
            })
        })
        $('.btn-ubah-adm').on('click', function (e) {
            e.preventDefault();
            let id_admin = $(this).data('id');
            $('#ubahModal').modal('show');
            $.getJSON(`admin/getAjax/${id_admin}`, function(data, status, xhr) {
                const {username, nama, id_admin} = data;
                $('#ubahModal #id').val(id_admin);
                $('#ubahModal #username').val(username);
                $('#ubahModal #nama-admin').val(nama);
            })
        })
        let arrayObat = [];
        $('.form-obat table .btn-remove-item').on('click', function() {
            if (arrayObat.length == 0) return alert('Belum ada item obat dipilih!');
            arrayObat = [];
            $('.form-obat table tbody').html('');
            $('.form-obat #data_obat').val('');
            countGrandTotal();
        })
        $('.form-obat .add-item-obat').on('click', function(e) {
            let kode = $('.form-obat #obat').val();
            // if (! kode) return alert('Kode obat tidak valid');
            if (arrayObat.filter(item => item.kode == kode).length > 0) return alert('Data Obat Sudah Dipilih');
            if (arrayObat.length == 0) $('.form-obat table tbody .item-kosong').hide();
            $.getJSON(`../obat/getAjax/${kode}`, function(data, status, xhr) {
                let html = `
                <tr id="${data.kode}">
                    <td><button data-kode="${data.kode}" type="button" class="btn-remove-obat btn btn-circle btn-danger btn-sm"><i class="fa fa-trash"></i></button></td>
                    <td>${data.kode}</td>
                    <td>${data.nama_obat}</td>
                    <td><img src="${data.foto}" width="50"/></td>
                    <td>Rp.${data.harga}</td>
                    <td width="100"><input data-harga="${data.harga}" data-kode="${data.kode}" type="number" class="form-control jumlah" value="1" min="1" /></td>
                    <td>Rp.${data.harga}</td>
                </tr>
                `;
                arrayObat.push({
                    kode: data.kode,
                    jumlah: 1,
                    total: data.harga
                });

                let grand_total = 0;

                let jumlah_total = `<input name="jumlah_uang" value="0" class="form-control col-sm-5 jumlah_uang">`;

                let kembalian   = 0;
                arrayObat.forEach(val => grand_total = grand_total + parseInt(val.total));
                // arrayObat.forEach(val => kembalian = jumlah_total - grand_total);
                $('.form-obat table tbody').append(html);
                $('.form-obat table tfoot').show();
                $('.form-obat .grand-total').html(`<h4><input name="grand_total" value="${grand_total}" class="form-control col-sm-5" readonly></h4>`);
                $('.form-obat .jumlah_uang').html(`<h4>${jumlah_total}</h4>`);
                $('.form-obat .kembalian').html(`<h4><input name="kembalian" value="${kembalian}" class="form-control col-sm-5" readonly></h4>`);
                $('.form-obat #data_obat').val(JSON.stringify(arrayObat));
            })
        })

        $('.form-obat table').on('click', '.btn-remove-obat', function() {
            $(this).parent().parent().remove();
            let kode = $(this).data('kode');
            arrayObat = arrayObat.filter(e => e.kode != kode);
            $('.form-obat #data_obat').val(JSON.stringify(arrayObat));
            countGrandTotal();
        })

        $('.form-obat table').on('change', '.jumlah', function() {
            let kode = $(this).data('kode');
            let jumlah = $(this).val();
            let harga = $(this).data('harga');
            let total = harga * jumlah;
            $(`.form-obat #${kode} td:last`).html(`Rp.${total}`)
            objIndex = arrayObat.findIndex((obj => obj.kode == kode));
            arrayObat[objIndex].jumlah = jumlah;
            arrayObat[objIndex].total = total;
            countGrandTotal();
            $('.form-obat #data_obat').val(JSON.stringify(arrayObat));
        })

        $('.form-obat table').on('change', '.jumlah_uang', function() {

            let jumlah_uang = $(this).val();
            let grand_total = 0;
            arrayObat.forEach(val => grand_total = grand_total + parseInt(val.total));
            // let grand_total2 = grand_total;
            let kembalian = jumlah_uang - grand_total;
            $(`.form-obat th:last`).html(`<h4><input name="kembalian" value="${kembalian}" class="form-control col-sm-5" readonly></h4>`)
            // objIndex = arrayObat.findIndex((obj => obj.kode == kode));
            arrayObat[objIndex].jumlah_uang = jumlah_uang;
            arrayObat[objIndex].kembalian = kembalian;
            countGrandTotal();
            $('.form-obat #data_obat').val(JSON.stringify(arrayObat));
        })

        function countGrandTotal() {
            let grand_total = 0;
            arrayObat.forEach(val => grand_total = grand_total + parseInt(val.total));
            if (grand_total <= 0) {
                $('.form-obat table tfoot').hide();
                $('.form-obat table tbody .item-kosong').show();
            }
            $('.form-obat .grand-total').html(`<h4>Rp.${grand_total}</h4>`);
        }

        $('.form-obat').on('submit', function(e) {
            e.preventDefault();

            $.post('store', $(this).serialize(), function(data, status, xhr) {
                if (! data.status) {
                    $('.error-form').html(data.error);
                    let cardOffset = $('#card-transaksi').offset();
                    let bodyOffset = $(document).scrollTop();
                    if (cardOffset.top <= bodyOffset) {
                        $('html, body').animate({
                            scrollTop: cardOffset.top,
                        }, 1000)
                    }
                    return;
                }
                document.location.href = '../transaksi';
            }, 'json');
        })
    </script>

   
	
    <!-- datatabels-->
    <script src="<?php echo base_url('assets/admin/') ;?>vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ;?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
    <script src="<?php echo base_url('assets/admin/') ;?>js/demo/dataTables-demo.js"></script>

    <!-- <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script> -->

    
	

    