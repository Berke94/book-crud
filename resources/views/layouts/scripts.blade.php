<!-- resources/views/layouts/scripts.blade.php -->

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script>
    $(document).ready(function() {
        $('#author_name').autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "{{ route('authors.search') }}",
                    dataType: "json",
                    data: {
                        term: request.term
                    },
                    success: function(data) {
                        response(data);
                    },
                    error: function() {
                        response([]);
                    }
                });
            },
            select: function(event, ui) {
                $('#author_id').val(ui.item.id);
                $('#author_name').val(ui.item.label);
                return false;
            }
        });
    });

    function formatISBN(input) {
        let value = input.value.replace(/\D/g, '');
        let formattedValue = '';

        for (let i = 0; i < value.length && i < 13; i++) {
            if (i > 0 && i % 3 === 0 && i < 13) {
                formattedValue += '-';
            }
            formattedValue += value[i];
        }

        input.value = formattedValue;
    }

</script>
