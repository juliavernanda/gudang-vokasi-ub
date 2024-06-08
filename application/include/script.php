<script>
  $(document).ready(function() {
    $('table.dataTables-search').DataTable({
      "pagingType": "full_numbers",
      "lengthChange": false,
      "lengthMenu": [
        [5]
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search",
      }
    });

    $('table.dataTables').DataTable({
      "pagingType": "full_numbers",
      "lengthMenu": [
        [10, 25, 50, 75, -1],
        [10, 25, 50, 75, "All"]
      ],
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search",
      }
    });

    $('table.dataTables-length').DataTable({
      "pagingType": "full_numbers",
      responsive: true,
      language: {
        search: "_INPUT_",
        searchPlaceholder: "Search",
      }
    });
  });
</script>
