<div class="card">
    <div class="row">
        <div class="col">
            <div class="card-header">
                <h4>Réservez votre Séance</h4>
            </div>
            <div class="card-body">
                <table class="table table-hover table-sm">
                    <thead>
                    <tr>
                        <th> NOM DU TARIF</th>
                        <th> PRIX DU TARIF</th>
                        <th> NOMBRE DE PLACE </th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($prices as $p) { ?>
                    <tr class="tatayoyo" data-id="<?= $p['id']; ?>">
                        <td><?= $p['name'] ; ?></td>
                        <td class="amount" data-price="<?= $p['amount'] ; ?>"><?= $p['amount'] ; ?> €</td>
                        <td>
                            <span class="place-minus" >
                                <i class="fa-solid fa-circle-minus me-2"></i>
                            </span>

                            <input style="width: 40px; text-align: right;" class="numbers" type="text" value="0" min="0" name="compteur" readonly>

                            <span class="place-plus">
                                <i class="fa-solid fa-circle-plus ms-2"></i>
                            </span>
                        </td>
                    </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="card-footer d-flex justify-content-between">
                <span id="totalPrice">Total : 0€</span>
                <button type="submit" class="btn btn-primary">Réserver</button>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        let totalPrice = 0;
        $('.place-minus').on('click', function () {
            let price = $(this).closest('tr').find('.amount').data('price');
            let init_place = $(this).closest('tr').find('.numbers').val();
            if (init_place > 0) {
                init_place --;
                $(this).closest('td').find('.numbers').attr('value', init_place);
                totalPrice = parseFloat(totalPrice) - parseFloat(price);
                $('#totalPrice').html('Total : ' + totalPrice + '€');
                console.log(price);
            }
        });
        $('.place-plus').on('click', function () {
            let price = $(this).closest('tr').find('.amount').data('price');
            let init_place = $(this).closest('tr').find('.numbers').val();
            init_place ++;
            $(this).closest('td').find('.numbers').attr('value', init_place);
            totalPrice = parseFloat(totalPrice) + parseFloat(price);
            $('#totalPrice').html('Total : ' + totalPrice + '€');
            console.log(price);
        });
    });
</script>