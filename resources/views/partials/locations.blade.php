<script>
    $(document).ready(function() {
        var oldCountryID = "{{ old('country_id', $company->country_id ?? '') }}";
        var oldStateID = "{{ old('state_id', $company->state_id ?? '') }}";
        var oldCityID = "{{ old('city_id', $company->city_id ?? '') }}";

        // if (oldCountryID) {
        //     $('#country').val(oldCountryID).trigger('change');
        // }

        $('#country').change(function() {
            var countryID = $(this).val();
            if (countryID) {
                $.ajax({
                    url: '/get-states/' + countryID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#state').empty();
                        $('#state').append(
                            '<option value="">Seleccione un estado</option>');
                        $.each(data, function(key, value) {
                            $('#state').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                        // if (oldStateID) {
                        //     $('#state').val(oldStateID).trigger('change');
                        // }
                    }
                });
            } else {
                $('#state').empty();
                $('#city').empty();
            }
        });

        $('#state').change(function() {
            var stateID = $(this).val();
            if (stateID) {
                $.ajax({
                    url: '/get-cities/' + stateID,
                    type: "GET",
                    dataType: "json",
                    success: function(data) {
                        $('#city').empty();
                        $('#city').append(
                            '<option value="">Seleccione una ciudad</option>');
                        $.each(data, function(key, value) {
                            $('#city').append('<option value="' + value.id + '">' +
                                value.name + '</option>');
                        });
                        if (oldCityID) {
                            $('#city').val(oldCityID);
                        }
                    }
                });
            } else {
                $('#city').empty();
            }
        });

        // Trigger change event for state if oldStateID is set
        // if (oldStateID) {
        //     $('#state').trigger('change');
        // }
    });
</script>