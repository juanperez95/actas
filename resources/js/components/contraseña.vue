<template>
    <div class="change-password-container">
      <img src="@/assets/americas.png" alt="Américas BPS Logo" class="logo">
      <form @submit.prevent="changePassword">
        <div class="input-group">
          <i class="fas fa-id-card"></i>
          <input v-model="cedula" type="text" placeholder="Cédula" required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input v-model="newPassword" type="password" placeholder="Nueva Contraseña" required>
        </div>
        <div class="input-group">
          <i class="fas fa-lock"></i>
          <input v-model="confirmPassword" type="password" placeholder="Confirmar Contraseña" required>
        </div>
        <button type="submit">Cambiar Contraseña</button>
      </form>
    </div>
  </template>
  
  <script>
  export default {
    name: 'ChangePassword',
    data() {
      return {
        cedula: '',
        newPassword: '',
        confirmPassword: ''
      }
    },
    methods: {
      changePassword() {
        // Aquí iría la lógica para manejar el cambio de contraseña
        if (this.newPassword !== this.confirmPassword) {
          alert('Las contraseñas no coinciden');
          return;
        }
        console.log('Intentando cambiar la contraseña para:', this.cedula);
      }
    }
  }
  </script>
  
  <style scoped>
   body {
            font-family: Arial, sans-serif;
            background: rgb(255,177,50);
            background: linear-gradient(0deg, rgba(255,177,50,1) 0%, rgba(215,91,30,1) 100%);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .change-password-container {
            background-color: white;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        .logo {
            max-width: 200px;
            margin-bottom: 20px;
        }
        .input-group {
            position: relative;
            margin-bottom: 20px;
        }
        .input-group input {
            width: 100%;
            padding: 10px 10px 10px 40px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .input-group i {
            position: absolute;
            left: 12px;
            top: 12px;
            color: #888;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #B7002C;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #830724;
        }
  </style>