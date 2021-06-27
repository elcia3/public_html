<form method="POST">
    <p>
        <label for="id_zip_code">郵便番号</label><br>
        <div>
            <input type="text" name="zip_code" maxlength="7" required="" id="id_zip_code" placeholder="郵便番号">
            <span>
                <button id="search-button" type="button">
                    住所取得
                </button>
            </span>
        </div>
    </p>
    <p>
        <label for="id_address1">都道府県</label><br>
        <input type="text" name="address1" maxlength="5" required="" id="id_address1" placeholder="都道府県">
    </p>
    <p>
        <label for="id_address2">市区町村・番地</label><br>
        <input type="text" name="address2" maxlength="50" required="" id="id_address2" placeholder="市区町村・番地">
    </p>
    <p>
        <label for="id_address3">建物名・部屋番号</label><br>
        <input type="text" name="address3" maxlength="50" id="id_address3" placeholder="建物名・部屋番号">
    </p>
    <div>
        <input type="submit" value="保存"></input>
    </div>
</form>

<script type="text/javascript">
    $(document).on('click', '#search-button', function(event){
        $.ajax({
            url: 'https://maps.googleapis.com/maps/api/geocode/json',
            type: 'GET',
            dataType: 'json',
            data: {
                key: 'AIzaSyAKg8mWwhNfNYVz-myQD-pe-tlTrDpLS78',
                address: $('#id_zip_code').val(),
                language: 'ja'
            }
        }).done(function(data) {
            if (data.status == "OK") {
                var components = data.results[0].address_components;
                if (components.length == 5) {
                    $('#id_address1').val(components[3].long_name);
                    $('#id_address2').val(components[2].long_name + components[1].long_name);
                } else if (components.length == 6) {
                    $('#id_address1').val(components[4].long_name);
                    $('#id_address2').val(components[3].long_name + components[2].long_name);
                }
            }
        });
    });
</script>
