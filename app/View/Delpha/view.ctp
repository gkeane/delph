    <!-- File: /app/views/delpha/view.ctp -->
   <h1>Blog posts</h1>
   <table>
   <tr>
   <th>ids</th>
   </tr>
   <!-- Here is where we loop through our $posts array, printing out post info -->
   <?php foreach ($delphs as $d): ?>
   <tr>
   <td><?php echo $d['Delpha']['fullcitation']; ?></td>
   </tr>
   <?php endforeach; ?>
    
   </table>
