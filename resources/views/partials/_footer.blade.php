<script>
            function formatNominal(input) {
                // Remove non-numeric characters
                let value = input.value.replace(/\D/g, '');
                
                // Format with dots
                input.value = formatNumberWithDots(value);
            }

            function formatNumberWithDots(number) {
                return new Intl.NumberFormat('id-ID').format(number);
            }
        </script>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="footer-copyright">
                <p>© @php date_default_timezone_set('Asia/Dhaka') @endphp {{ date('Y') }}<a href="https://wa.me/62895605805888?text=Info+lebih+lanjut+tentang+masboy+dan+sistem+informasi+lainnya">SIBAKAT </a> &nbsp; (Mulai Penggunaan September 2024) </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="footer-menu text-end">
                <ul>
                    <li><a href="https://www.baznasboyolali.or.id">Team</a></li>
                    <li><a href="https://api.whatsapp.com/send/?phone=62895605805888">Contact</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>