<?php
	$this->load->view('admin/template/header');
	$this->load->view('admin/template/userbar');
	$this->load->view('admin/template/messages');	
?>
	<div id="body">
		<div class="block big"><!-- Block Begin -->
			<div class="titlebar">
				<h3>Usuarios</h3>
				<a href="#" class="toggle">&nbsp;</a>
			</div>
			
			<div class="block_cont">
				<div class="abmButtons list">
					<input type="button" class="button" value="Nuevo" onclick="javascript: location.href='<?php echo base_url()?>user/add'">
				</div>
				<table class="data-table"><!-- Table Wrapper Begin -->
					<thead>
						<tr>
						<th width="40"><input type="checkbox" name="check" value="-"></th>
						<th>Id</th>
						<th>Nombre de Usuario</th>
						<th>Nombre</th>
						<th>E-mail</th>
						<th>Rol</th>
						<th width="80" class="sorting_disabled">Acciones</th>
						</tr>
					</thead>
					<?php
						foreach($users as $user):
							$role = getRoleDescription($user->getRoleId());
					?>
					<tr>
						<td><input type="checkbox" name="check" value="-"></td>
						<td><?php echo $user->getId()?></td>
						<td><?php echo $user->getUsername()?></td>
						<td><?php echo $user->getName() . " " . $user->getSurname()?></td>
						<td><?php echo $user->getEmail()?></td>
						<td><?php echo $role->description?></td>
						<td>
							<div style="height: 3px;">&nbsp;</div>
							<div class="actionbar">
								<a href="<?php echo base_url()?>user/modify/<?php echo $user->getId()?>" class="action edit">
									<span>Editar</span>
								</a>
								<a href="javascript: deleteRow('<?php echo base_url()?>user/delete/<?php echo $user->getId()?>');" class="action delete">
									<span>Eliminar</span>
								</a>
							</div>
						</td>
					</tr>
					<?php
						endforeach;
					?>
				</table><!-- Table Wrapper End -->
			</div>
		</div><!-- Block End -->
	</div>
<?php
	$this->load->view('admin/template/footer');
?>