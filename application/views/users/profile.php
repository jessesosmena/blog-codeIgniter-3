<table class="table table-striped table-hover ">
  <thead>
    <tr>
      <th>First Name</th>
      <th>Last Name</th>
      <th>Email</th>
      <th>Username</th>
      <th>Created at</th>
    </tr>
  </thead>
  <tbody>
    <tr class="success">
      <td><?php echo ucfirst($this->session->userdata('first_name')) ?></td>
      <td><?php echo ucfirst($this->session->userdata('last_name')) ?></td>
      <td><?php echo ucfirst($this->session->userdata('email')) ?></td>
      <td><?php echo ucfirst($this->session->userdata('username')) ?></td>
      <td><?php echo ucfirst($this->session->userdata('created_at')) ?></td>
    </tr>
  </tbody>
</table> 