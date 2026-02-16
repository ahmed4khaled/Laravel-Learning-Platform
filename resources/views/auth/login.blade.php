@extends('layout.app')
@extends('layout.navbar')


@section('title', 'تسجيل الدخول -  ')

@section('styles')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
@endsection

@section('content')
<style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

:root {
  --primary-color: #6366f1;
  --secondary-color: #8b5cf6;
  --accent-color: #a855f7;
  --success-color: #10b981;
  --warning-color: #f59e0b;
  --danger-color: #ef4444;
  --dark-color: #1f2937;
  --light-color: #f8fafc;
  --white: #ffffff;
  --gray-100: #f3f4f6;
  --gray-200: #e5e7eb;
  --gray-300: #d1d5db;
  --gray-400: #9ca3af;
  --gray-500: #6b7280;
  --gray-600: #4b5563;
  --gray-700: #374151;
  --gray-800: #1f2937;
  --gray-900: #111827;
  --gradient-primary: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  --gradient-secondary: linear-gradient(135deg, var(--secondary-color), var(--accent-color));
  --gradient-success: linear-gradient(135deg, #10b981, #059669);
  --gradient-warning: linear-gradient(135deg, #f59e0b, #d97706);
  --gradient-danger: linear-gradient(135deg, #ef4444, #dc2626);
  --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
  --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06);
  --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
  --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
  --shadow-xl: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
  --shadow-2xl: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
  --border-radius-sm: 0.375rem;
  --border-radius: 0.5rem;
  --border-radius-md: 0.75rem;
  --border-radius-lg: 1rem;
  --border-radius-xl: 1.5rem;
  --border-radius-2xl: 2rem;
  --border-radius-full: 9999px;
  --transition-fast: 0.1s ease;
  --transition-normal: 0.2s ease;
  --transition-slow: 0.3s ease;
}

body {
  font-family: Tahoma, Arial, sans-serif;
  direction: rtl;
  overflow-x: hidden;
  background: linear-gradient(135deg, var(--light-color) 0%, #e0e7ff 50%, #f3e8ff 100%);
  line-height: 1.6;
  color: var(--gray-700);
  min-height: 100vh;
}

.container {
  max-width: 1200px;
  margin: 0 auto;
  padding: 0 20px;
}

/* Loading Screen */
.loading-screen {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
  display: none;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  transition: opacity 0.3s ease, visibility 0.3s ease;
}

.loading-screen.show {
  display: flex;
}

.loading-content {
  text-align: center;
  color: white;
}

.loading-atom {
  position: relative;
  width: 80px;
  height: 80px;
  margin: 0 auto 20px;
}

.loading-nucleus {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 10px;
  height: 10px;
  background: white;
  border-radius: 50%;
  transform: translate(-50%, -50%);
  box-shadow: 0 0 15px white;
}

.loading-orbit {
  position: absolute;
  top: 50%;
  left: 50%;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  transform: translate(-50%, -50%);
}

.loading-orbit.orbit-1 {
  width: 60px;
  height: 60px;
  animation: loadingOrbit 2s linear infinite;
}

.loading-orbit.orbit-2 {
  width: 80px;
  height: 80px;
  animation: loadingOrbit 1.5s linear infinite reverse;
}

.loading-electron {
  position: absolute;
  width: 4px;
  height: 4px;
  background: white;
  border-radius: 50%;
  top: -2px;
  left: 50%;
  transform: translateX(-50%);
  box-shadow: 0 0 8px white;
}

.loading-content h2 {
  font-size: 20px;
  font-weight: 600;
  margin-bottom: 15px;
}

.loading-bar {
  width: 150px;
  height: 3px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 2px;
  overflow: hidden;
  margin: 0 auto;
}

.loading-progress {
  height: 100%;
  background: white;
  border-radius: 2px;
  animation: loadingProgress 2s ease-in-out infinite;
}

@keyframes loadingOrbit {
  0% {
    transform: translate(-50%, -50%) rotate(0deg);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}

@keyframes loadingProgress {
  0%,
  100% {
    width: 0%;
  }
  50% {
    width: 100%;
  }
}

/* Enhanced Physics Background */
.physics-background {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
  z-index: -1;
  overflow: hidden;
}

/* Enhanced Atoms */
.atom {
  position: absolute;
  width: 80px;
  height: 80px;
}

.atom-1 {
  top: 15%;
  left: 10%;
  animation: atomFloat 20s ease-in-out infinite;
}

.atom-2 {
  top: 60%;
  right: 15%;
  animation: atomFloat 25s ease-in-out infinite reverse;
}

.atom-3 {
  bottom: 20%;
  left: 60%;
  animation: atomFloat 30s ease-in-out infinite;
}

.nucleus {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 8px;
  height: 8px;
  background: radial-gradient(circle, var(--primary-color), var(--secondary-color));
  border-radius: 50%;
  transform: translate(-50%, -50%);
  box-shadow: 0 0 12px var(--primary-color);
  animation: nucleusPulse 3s ease-in-out infinite;
}

.electron-orbit {
  position: absolute;
  top: 50%;
  left: 50%;
  border: 2px solid rgba(99, 102, 241, 0.4);
  border-radius: 50%;
  transform: translate(-50%, -50%);
}

.orbit-1 {
  width: 60px;
  height: 60px;
  animation: orbitRotate 3s linear infinite;
}

.orbit-2 {
  width: 40px;
  height: 40px;
  animation: orbitRotate 2s linear infinite reverse;
}

.electron {
  position: absolute;
  width: 4px;
  height: 4px;
  background: var(--warning-color);
  border-radius: 50%;
  top: -2px;
  left: 50%;
  transform: translateX(-50%);
  box-shadow: 0 0 6px var(--warning-color);
  animation: electronGlow 2s ease-in-out infinite;
}

.atom-glow {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 100px;
  height: 100px;
  background: radial-gradient(circle, rgba(99, 102, 241, 0.1), transparent);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  animation: atomGlowPulse 4s ease-in-out infinite;
}

/* Enhanced Particles */
.particle {
  position: absolute;
  width: 6px;
  height: 6px;
  background: radial-gradient(circle, var(--accent-color), var(--secondary-color));
  border-radius: 50%;
  box-shadow: 0 0 10px var(--accent-color);
}

.particle-1 {
  top: 20%;
  left: 80%;
  animation: particleFloat1 15s linear infinite;
}

.particle-2 {
  top: 50%;
  left: 5%;
  animation: particleFloat2 18s linear infinite;
}

.particle-3 {
  top: 80%;
  left: 70%;
  animation: particleFloat3 20s linear infinite;
}

.particle-4 {
  top: 30%;
  right: 10%;
  animation: particleFloat4 16s linear infinite;
}

.particle-5 {
  bottom: 40%;
  left: 40%;
  animation: particleFloat5 22s linear infinite;
}

.particle-6 {
  top: 10%;
  left: 50%;
  animation: particleFloat6 24s linear infinite;
}

/* Enhanced Formulas */
.formula {
  position: absolute;
  font-family: "Courier New", monospace;
  font-size: 14px;
  font-weight: bold;
  color: rgba(99, 102, 241, 0.4);
  user-select: none;
  text-shadow: 0 0 8px rgba(99, 102, 241, 0.3);
}

.formula-1 {
  top: 15%;
  right: 10%;
  animation: formulaFloat1 12s ease-in-out infinite;
}

.formula-2 {
  bottom: 25%;
  left: 15%;
  animation: formulaFloat2 14s ease-in-out infinite;
}

.formula-3 {
  top: 60%;
  right: 25%;
  animation: formulaFloat3 16s ease-in-out infinite;
}

.formula-4 {
  top: 35%;
  left: 75%;
  animation: formulaFloat4 18s ease-in-out infinite;
}

/* Enhanced Light Rays */
.light-ray {
  position: absolute;
  width: 100px;
  height: 2px;
  background: linear-gradient(90deg, transparent, rgba(251, 191, 36, 0.6), transparent);
  transform-origin: left center;
  border-radius: 1px;
  box-shadow: 0 0 6px rgba(251, 191, 36, 0.4);
}

.ray-1 {
  top: 25%;
  left: 40%;
  animation: lightRay1 8s ease-in-out infinite;
}

.ray-2 {
  top: 55%;
  right: 20%;
  animation: lightRay2 10s ease-in-out infinite;
}

.ray-3 {
  bottom: 35%;
  left: 60%;
  animation: lightRay3 12s ease-in-out infinite;
}

/* Enhanced Electric Sparks */
.electric-spark {
  position: absolute;
  width: 30px;
  height: 30px;
}

.spark-1 {
  top: 40%;
  left: 60%;
  animation: sparkFloat 6s ease-in-out infinite;
}

.spark-2 {
  top: 70%;
  right: 30%;
  animation: sparkFloat 8s ease-in-out infinite reverse;
}

.spark-line {
  position: absolute;
  width: 20px;
  height: 2px;
  background: linear-gradient(90deg, transparent, var(--warning-color), transparent);
  transform-origin: left center;
  animation: sparkFlash 2s ease-in-out infinite;
  border-radius: 1px;
}

.spark-line:nth-child(1) {
  transform: rotate(0deg);
}

.spark-line:nth-child(2) {
  transform: rotate(45deg);
  animation-delay: 0.3s;
}

.spark-center {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 6px;
  height: 6px;
  background: radial-gradient(circle, var(--warning-color), #d97706);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  box-shadow: 0 0 10px var(--warning-color);
  animation: sparkCenterGlow 2s ease-in-out infinite;
}

/* Auth Header */
.auth-header {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background: rgba(255, 255, 255, 0.95);
  backdrop-filter: blur(20px);
  border-bottom: 1px solid rgba(99, 102, 241, 0.1);
  z-index: 1000;
  padding: 1rem 0;
}

.header-content {
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.back-btn {
  display: flex;
  align-items: center;
  gap: 8px;
  text-decoration: none;
  color: var(--gray-600);
  font-weight: 500;
  padding: 10px 16px;
  border-radius: 12px;
  transition: all var(--transition-normal);
  border: 1px solid var(--gray-200);
}

.back-btn:hover {
  color: var(--primary-color);
  background: rgba(99, 102, 241, 0.1);
  transform: translateY(-2px);
}

.logo-container {
  display: flex;
  align-items: center;
  gap: 12px;
}

.logo-icon {
  position: relative;
  width: 40px;
  height: 40px;
  background: var(--gradient-primary);
  border-radius: 12px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: white;
  font-size: 20px;
  overflow: hidden;
}

.logo-rings {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.ring {
  position: absolute;
  border: 2px solid rgba(255, 255, 255, 0.3);
  border-radius: 50%;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

.ring-1 {
  width: 50px;
  height: 50px;
  animation: logoRing1 4s linear infinite;
}

.ring-2 {
  width: 60px;
  height: 60px;
  animation: logoRing2 6s linear infinite reverse;
}

.logo-text h1 {
  font-size: 20px;
  font-weight: 700;
  color: var(--dark-color);
  margin-bottom: 2px;
}

.logo-text p {
  font-size: 12px;
  color: var(--gray-600);
  font-weight: 500;
}

/* Auth Section */
.auth-section {
  padding: 120px 0 60px;
  min-height: 100vh;
  display: flex;
  align-items: center;
}

.auth-container {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 60px;
  align-items: center;
  max-width: 1000px;
  margin: 0 auto;
}

.register-container {
  grid-template-columns: 1fr 1fr;
}

/* Auth Card */
.auth-card {
  background: white;
  padding: 50px;
  border-radius: var(--border-radius-2xl);
  box-shadow: var(--shadow-2xl);
  border: 1px solid rgba(99, 102, 241, 0.1);
  position: relative;
  overflow: hidden;
}

.auth-card::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 4px;
  background: var(--gradient-primary);
}

.auth-header {
  text-align: center;
  margin-bottom: 40px;
}

.auth-icon {
  position: relative;
  width: 80px;
  height: 80px;
  background: var(--gradient-primary);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 20px;
  color: white;
  font-size: 32px;
}

.icon-glow {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 120%;
  height: 120%;
  background: var(--gradient-primary);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  opacity: 0.3;
  animation: iconGlow 3s ease-in-out infinite;
  z-index: -1;
}

.auth-header h2 {
  font-size: 28px;
  font-weight: 700;
  color: var(--dark-color);
  margin-bottom: 10px;
}

.auth-header p {
  color: var(--gray-600);
  font-size: 16px;
  line-height: 1.6;
}

/* Form Styles */
.auth-form {
  width: 100%;
}

.form-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 20px;
}

.form-group {
  margin-bottom: 25px;
}

.form-group label {
  display: block;
  font-weight: 600;
  color: var(--gray-700);
  margin-bottom: 8px;
  font-size: 14px;
}

.input-container {
  position: relative;
}

.input-container input,
.input-container select {
  width: 100%;
  padding: 15px 50px 15px 20px;
  border: 2px solid var(--gray-200);
  border-radius: var(--border-radius-lg);
  font-size: 15px;
  transition: all var(--transition-normal);
  font-family: inherit;
  background: white;
}

.input-container input:focus,
.input-container select:focus {
  outline: none;
  border-color: var(--primary-color);
  box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
  transform: translateY(-2px);
}

.input-icon {
  position: absolute;
  right: 15px;
  top: 50%;
  transform: translateY(-50%);
  color: var(--gray-400);
  font-size: 16px;
  pointer-events: none;
}

.toggle-password {
  position: absolute;
  left: 15px;
  top: 50%;
  transform: translateY(-50%);
  background: none;
  border: none;
  color: var(--gray-400);
  cursor: pointer;
  font-size: 16px;
  transition: color var(--transition-normal);
}

.toggle-password:hover {
  color: var(--primary-color);
}

.input-glow {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  border: 2px solid var(--primary-color);
  border-radius: var(--border-radius-lg);
  opacity: 0;
  transition: opacity var(--transition-normal);
  pointer-events: none;
}

.input-container input:focus + .input-icon + .toggle-password + .input-glow,
.input-container input:focus + .input-icon + .input-glow,
.input-container select:focus + .input-icon + .input-glow {
  opacity: 0.3;
  animation: inputGlow 2s ease-in-out infinite;
}

/* Password Strength */
.password-strength {
  margin-top: 8px;
}

.strength-bar {
  width: 100%;
  height: 4px;
  background: var(--gray-200);
  border-radius: 2px;
  overflow: hidden;
  margin-bottom: 5px;
}

.strength-fill {
  height: 100%;
  width: 0%;
  border-radius: 2px;
  transition: all var(--transition-normal);
}

.strength-text {
  font-size: 12px;
  color: var(--gray-500);
}

/* Form Options */
.form-options {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-bottom: 25px;
  flex-wrap: wrap;
  gap: 15px;
}

.checkbox-container {
  display: flex;
  align-items: center;
  cursor: pointer;
  font-size: 14px;
  color: var(--gray-600);
  position: relative;
}

.checkbox-container input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

.checkmark {
  width: 18px;
  height: 18px;
  background: white;
  border: 2px solid var(--gray-300);
  border-radius: 4px;
  margin-left: 10px;
  position: relative;
  transition: all var(--transition-normal);
}

.checkbox-container:hover .checkmark {
  border-color: var(--primary-color);
}

.checkbox-container input:checked ~ .checkmark {
  background: var(--gradient-primary);
  border-color: var(--primary-color);
}

.checkmark::after {
  content: "";
  position: absolute;
  display: none;
  left: 5px;
  top: 2px;
  width: 4px;
  height: 8px;
  border: solid white;
  border-width: 0 2px 2px 0;
  transform: rotate(45deg);
}

.checkbox-container input:checked ~ .checkmark::after {
  display: block;
}

.forgot-password,
.terms-link,
.privacy-link {
  color: var(--primary-color);
  text-decoration: none;
  font-size: 14px;
  transition: color var(--transition-normal);
}

.forgot-password:hover,
.terms-link:hover,
.privacy-link:hover {
  color: var(--secondary-color);
  text-decoration: underline;
}

/* Auth Button */
.auth-btn {
  width: 100%;
  padding: 16px 24px;
  background: var(--gradient-primary);
  color: white;
  border: none;
  border-radius: var(--border-radius-lg);
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: all var(--transition-normal);
  position: relative;
  overflow: hidden;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 10px;
  margin-bottom: 25px;
}

.auth-btn:hover {
  transform: translateY(-3px);
  box-shadow: 0 15px 35px rgba(99, 102, 241, 0.4);
}

.auth-btn:active {
  transform: translateY(-1px);
}

.btn-particles {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  pointer-events: none;
}

.btn-particle {
  position: absolute;
  width: 4px;
  height: 4px;
  background: rgba(255, 255, 255, 0.8);
  border-radius: 50%;
  animation: btnParticleFloat 3s ease-in-out infinite;
}

.btn-particle:nth-child(1) {
  top: 20%;
  left: 20%;
  animation-delay: 0s;
}

.btn-particle:nth-child(2) {
  top: 60%;
  right: 30%;
  animation-delay: 1s;
}

.btn-particle:nth-child(3) {
  bottom: 30%;
  left: 60%;
  animation-delay: 2s;
}

/* Auth Divider */
.auth-divider {
  text-align: center;
  margin: 25px 0;
  position: relative;
}

.auth-divider::before {
  content: "";
  position: absolute;
  top: 50%;
  left: 0;
  right: 0;
  height: 1px;
  background: var(--gray-200);
}

.auth-divider span {
  background: white;
  padding: 0 15px;
  color: var(--gray-500);
  font-size: 14px;
  position: relative;
  z-index: 1;
}

/* Social Login */
.social-login {
  display: flex;
  gap: 15px;
  margin-bottom: 25px;
}

.social-btn {
  flex: 1;
  padding: 12px 20px;
  border: 2px solid var(--gray-200);
  border-radius: var(--border-radius-lg);
  background: white;
  color: var(--gray-600);
  font-size: 14px;
  font-weight: 500;
  cursor: pointer;
  transition: all var(--transition-normal);
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 8px;
}

.google-btn:hover {
  border-color: #db4437;
  color: #db4437;
  background: rgba(219, 68, 55, 0.05);
}

.facebook-btn:hover {
  border-color: #1877f2;
  color: #1877f2;
  background: rgba(24, 119, 242, 0.05);
}

/* Auth Footer */
.auth-footer {
  text-align: center;
  margin-top: 20px;
}

.auth-footer p {
  color: var(--gray-600);
  font-size: 14px;
}

.auth-link {
  color: var(--primary-color);
  text-decoration: none;
  font-weight: 600;
  transition: color var(--transition-normal);
}

.auth-link:hover {
  color: var(--secondary-color);
  text-decoration: underline;
}

/* Welcome Side */
.welcome-side {
  background: var(--gradient-primary);
  border-radius: var(--border-radius-2xl);
  padding: 50px;
  color: white;
  position: relative;
  overflow: hidden;
}

.welcome-side::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
  opacity: 0.3;
}

.welcome-content {
  position: relative;
  z-index: 2;
}

.welcome-icon {
  position: relative;
  width: 80px;
  height: 80px;
  background: rgba(255, 255, 255, 0.2);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
  margin: 0 auto 25px;
  font-size: 32px;
}

.welcome-glow {
  position: absolute;
  top: 50%;
  left: 50%;
  width: 120%;
  height: 120%;
  background: rgba(255, 255, 255, 0.1);
  border-radius: 50%;
  transform: translate(-50%, -50%);
  animation: welcomeGlow 4s ease-in-out infinite;
  z-index: -1;
}

.welcome-content h3 {
  font-size: 28px;
  font-weight: 700;
  margin-bottom: 15px;
  text-align: center;
}

.welcome-content > p {
  font-size: 16px;
  line-height: 1.6;
  margin-bottom: 30px;
  text-align: center;
  opacity: 0.9;
}

.features-list {
  margin-bottom: 30px;
}

.feature-item {
  display: flex;
  align-items: center;
  margin-bottom: 15px;
  font-size: 15px;
}

.feature-item i {
  margin-left: 12px;
  width: 20px;
  color: rgba(255, 255, 255, 0.8);
}

.stats-container {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 20px;
  margin-top: 30px;
}

.stat-item {
  text-align: center;
  padding: 15px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: var(--border-radius-lg);
  backdrop-filter: blur(10px);
}

.stat-number {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 5px;
}

.stat-label {
  font-size: 12px;
  opacity: 0.8;
}

.testimonial {
  margin-top: 30px;
  padding: 20px;
  background: rgba(255, 255, 255, 0.1);
  border-radius: var(--border-radius-lg);
  backdrop-filter: blur(10px);
}

.testimonial-content {
  position: relative;
}

.testimonial-content i {
  font-size: 24px;
  opacity: 0.3;
  margin-bottom: 10px;
}

.testimonial-content p {
  font-size: 14px;
  line-height: 1.6;
  margin-bottom: 15px;
  font-style: italic;
}

.testimonial-author strong {
  display: block;
  font-size: 14px;
  margin-bottom: 2px;
}

.testimonial-author span {
  font-size: 12px;
  opacity: 0.7;
}

/* Error Messages */
.field-error {
  color: var(--danger-color);
  font-size: 12px;
  margin-top: 5px;
  display: flex;
  align-items: center;
  gap: 5px;
}

.field-error::before {
  content: "⚠";
  font-size: 14px;
}

/* Success Messages */
.field-success {
  color: var(--success-color);
  font-size: 12px;
  margin-top: 5px;
  display: flex;
  align-items: center;
  gap: 5px;
}

.field-success::before {
  content: "✓";
  font-size: 14px;
}

/* Keyframe Animations */
@keyframes atomFloat {
  0%,
  100% {
    transform: translateY(0px) rotate(0deg);
  }
  50% {
    transform: translateY(-20px) rotate(180deg);
  }
}

@keyframes nucleusPulse {
  0%,
  100% {
    transform: translate(-50%, -50%) scale(1);
  }
  50% {
    transform: translate(-50%, -50%) scale(1.2);
  }
}

@keyframes orbitRotate {
  0% {
    transform: translate(-50%, -50%) rotate(0deg);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}

@keyframes electronGlow {
  0%,
  100% {
    box-shadow: 0 0 6px var(--warning-color);
  }
  50% {
    box-shadow: 0 0 12px var(--warning-color);
  }
}

@keyframes atomGlowPulse {
  0%,
  100% {
    opacity: 0.1;
    transform: translate(-50%, -50%) scale(1);
  }
  50% {
    opacity: 0.3;
    transform: translate(-50%, -50%) scale(1.1);
  }
}

@keyframes particleFloat1 {
  0%,
  100% {
    transform: translate(0, 0);
  }
  25% {
    transform: translate(20px, -30px);
  }
  50% {
    transform: translate(-15px, -40px);
  }
  75% {
    transform: translate(-25px, -15px);
  }
}

@keyframes particleFloat2 {
  0%,
  100% {
    transform: translate(0, 0);
  }
  33% {
    transform: translate(25px, 20px);
  }
  66% {
    transform: translate(-20px, 35px);
  }
}

@keyframes particleFloat3 {
  0%,
  100% {
    transform: translate(0, 0);
  }
  50% {
    transform: translate(30px, -20px);
  }
}

@keyframes particleFloat4 {
  0%,
  100% {
    transform: translate(0, 0);
  }
  25% {
    transform: translate(-25px, 30px);
  }
  75% {
    transform: translate(15px, 15px);
  }
}

@keyframes particleFloat5 {
  0%,
  100% {
    transform: translate(0, 0);
  }
  50% {
    transform: translate(-30px, -25px);
  }
}

@keyframes particleFloat6 {
  0%,
  100% {
    transform: translate(0, 0);
  }
  33% {
    transform: translate(20px, 35px);
  }
  66% {
    transform: translate(-15px, -20px);
  }
}

@keyframes formulaFloat1 {
  0%,
  100% {
    transform: translateY(0px) rotate(0deg);
  }
  50% {
    transform: translateY(-20px) rotate(3deg);
  }
}

@keyframes formulaFloat2 {
  0%,
  100% {
    transform: translateY(0px) rotate(0deg);
  }
  50% {
    transform: translateY(-18px) rotate(-2deg);
  }
}

@keyframes formulaFloat3 {
  0%,
  100% {
    transform: translateY(0px) rotate(0deg);
  }
  50% {
    transform: translateY(-25px) rotate(4deg);
  }
}

@keyframes formulaFloat4 {
  0%,
  100% {
    transform: translateY(0px) rotate(0deg);
  }
  50% {
    transform: translateY(-15px) rotate(-1deg);
  }
}

@keyframes lightRay1 {
  0%,
  100% {
    transform: rotate(0deg) scaleX(1);
    opacity: 0.6;
  }
  50% {
    transform: rotate(10deg) scaleX(1.2);
    opacity: 1;
  }
}

@keyframes lightRay2 {
  0%,
  100% {
    transform: rotate(0deg) scaleX(1);
    opacity: 0.6;
  }
  50% {
    transform: rotate(-8deg) scaleX(1.1);
    opacity: 1;
  }
}

@keyframes lightRay3 {
  0%,
  100% {
    transform: rotate(0deg) scaleX(1);
    opacity: 0.6;
  }
  50% {
    transform: rotate(15deg) scaleX(1.3);
    opacity: 1;
  }
}

@keyframes sparkFloat {
  0%,
  100% {
    transform: translateY(0px) rotate(0deg);
  }
  50% {
    transform: translateY(-15px) rotate(180deg);
  }
}

@keyframes sparkFlash {
  0%,
  90%,
  100% {
    opacity: 0;
    transform: scaleX(0);
  }
  5%,
  85% {
    opacity: 1;
    transform: scaleX(1);
  }
}

@keyframes sparkCenterGlow {
  0%,
  100% {
    box-shadow: 0 0 10px var(--warning-color);
  }
  50% {
    box-shadow: 0 0 16px var(--warning-color);
  }
}

@keyframes logoRing1 {
  0% {
    transform: translate(-50%, -50%) rotate(0deg);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}

@keyframes logoRing2 {
  0% {
    transform: translate(-50%, -50%) rotate(0deg);
  }
  100% {
    transform: translate(-50%, -50%) rotate(360deg);
  }
}

@keyframes iconGlow {
  0%,
  100% {
    opacity: 0.3;
    transform: translate(-50%, -50%) scale(1);
  }
  50% {
    opacity: 0.5;
    transform: translate(-50%, -50%) scale(1.05);
  }
}

@keyframes inputGlow {
  0%,
  100% {
    box-shadow: 0 0 5px var(--primary-color);
  }
  50% {
    box-shadow: 0 0 15px var(--primary-color);
  }
}

@keyframes btnParticleFloat {
  0%,
  100% {
    transform: translateY(0px);
    opacity: 0.8;
  }
  50% {
    transform: translateY(-12px);
    opacity: 1;
  }
}

@keyframes welcomeGlow {
  0%,
  100% {
    opacity: 0.1;
    transform: translate(-50%, -50%) scale(1);
  }
  50% {
    opacity: 0.3;
    transform: translate(-50%, -50%) scale(1.1);
  }
}

/* Mobile Responsive Design */
@media (max-width: 1024px) {
  .auth-container {
    grid-template-columns: 1fr;
    gap: 40px;
  }

  .register-container {
    grid-template-columns: 1fr;
  }

  .welcome-side {
    order: -1;
  }

  .stats-container {
    grid-template-columns: repeat(3, 1fr);
    gap: 15px;
  }
}

@media (max-width: 768px) {
  .container {
    padding: 0 15px;
  }

  .auth-section {
    padding: 100px 0 40px;
  }

  .auth-card {
    padding: 30px 20px;
  }

  .welcome-side {
    padding: 30px 20px;
  }

  .auth-header h2 {
    font-size: 24px;
  }

  .auth-icon {
    width: 60px;
    height: 60px;
    font-size: 24px;
  }

  .form-row {
    grid-template-columns: 1fr;
    gap: 0;
  }

  .input-container input,
  .input-container select {
    padding: 12px 45px 12px 15px;
    font-size: 14px;
  }

  .social-login {
    flex-direction: column;
  }

  .stats-container {
    grid-template-columns: repeat(3, 1fr);
    gap: 10px;
  }

  .stat-number {
    font-size: 20px;
  }

  .stat-item {
    padding: 10px;
  }

  .header-content {
    flex-direction: column;
    gap: 15px;
    text-align: center;
  }

  .back-btn {
    align-self: flex-start;
  }

  /* Reduce physics animations on mobile */
  .atom {
    width: 60px;
    height: 60px;
  }

  .particle {
    width: 4px;
    height: 4px;
  }

  .formula {
    font-size: 12px;
  }

  .light-ray {
    width: 80px;
  }

  .electric-spark {
    width: 25px;
    height: 25px;
  }
}

@media (max-width: 480px) {
  .auth-card {
    padding: 25px 15px;
  }

  .welcome-side {
    padding: 25px 15px;
  }

  .auth-header h2 {
    font-size: 20px;
  }

  .auth-icon {
    width: 50px;
    height: 50px;
    font-size: 20px;
  }

  .welcome-content h3 {
    font-size: 22px;
  }

  .stats-container {
    grid-template-columns: 1fr;
    gap: 10px;
  }

  .form-options {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }

  /* Hide some physics elements on very small screens */
  .formula,
  .light-ray {
    display: none;
  }
}

/* Print Styles */
@media print {
  .physics-background,
  .auth-header,
  .loading-screen {
    display: none;
  }

  .auth-section {
    padding: 20px 0;
  }

  .auth-container {
    grid-template-columns: 1fr;
    gap: 20px;
  }

  .welcome-side {
    display: none;
  }

  body {
    background: white;
    color: black;
  }

  .auth-card {
    box-shadow: none;
    border: 1px solid black;
  }
}

/* High DPI Displays */
@media (-webkit-min-device-pixel-ratio: 2), (min-resolution: 192dpi) {
  .auth-icon,
  .welcome-icon {
    image-rendering: -webkit-optimize-contrast;
    image-rendering: crisp-edges;
  }
}

/* Reduced Motion Preference */
@media (prefers-reduced-motion: reduce) {
  *,
  *::before,
  *::after {
    animation-duration: 0.01ms !important;
    animation-iteration-count: 1 !important;
    transition-duration: 0.01ms !important;
  }

  .physics-background {
    display: none;
  }
}

/* Enhanced Login Styles */
.main {
    padding-top: 100px;
    min-height: 100vh;
}

.login.section {
    padding: 60px 0;
    min-height: calc(100vh - 100px);
    display: flex;
    align-items: center;
}

.login-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
    max-width: 1200px;
    margin: 0 auto;
}

.login-form-wrapper {
    background: rgba(255, 255, 255, 0.95);
    backdrop-filter: blur(20px);
    padding: 50px;
    border-radius: 24px;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
    border: 1px solid rgba(99, 102, 241, 0.1);
    position: relative;
    overflow: hidden;
}

.login-form-wrapper::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 4px;
    background: var(--gradient-primary);
}

.login-header {
    text-align: center;
    margin-bottom: 40px;
}

.login-icon {
    position: relative;
    width: 80px;
    height: 80px;
    background: var(--gradient-primary);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 20px;
    color: white;
    font-size: 32px;
}

.login-title {
    font-size: 32px;
    font-weight: 700;
    color: var(--dark-color);
    margin-bottom: 10px;
}

.login-subtitle {
    color: var(--gray-600);
    font-size: 16px;
    line-height: 1.6;
}

.login-form {
    width: 100%;
}

.btn.btn-primary.login-submit-btn {
    width: 100%;
    padding: 16px 24px;
    background: var(--gradient-primary);
    color: white;
    border: none;
    border-radius: 16px;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: all var(--transition-normal);
    position: relative;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    margin-bottom: 25px;
}

.btn.btn-primary.login-submit-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px rgba(99, 102, 241, 0.4);
}

.btn-glow {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.3), transparent);
    transform: translateX(-100%);
    transition: transform 0.6s ease;
}

.btn.btn-primary.login-submit-btn:hover .btn-glow {
    transform: translateX(100%);
}

/* Enhanced Pendulum Animations */
.pendulum {
    position: absolute;
    width: 100px;
    height: 150px;
}

.pendulum-1 {
    top: 10%;
    left: 20%;
    animation: pendulumFloat 8s ease-in-out infinite;
}

.pendulum-2 {
    top: 50%;
    right: 10%;
    animation: pendulumFloat 10s ease-in-out infinite reverse;
}

.pendulum-3 {
    bottom: 20%;
    left: 70%;
    animation: pendulumFloat 12s ease-in-out infinite;
}

.pendulum-string {
    position: absolute;
    top: 0;
    left: 50%;
    width: 2px;
    height: 80px;
    background: linear-gradient(to bottom, var(--gray-400), var(--gray-600));
    transform-origin: top center;
    animation: pendulumSwing 4s ease-in-out infinite;
}

.pendulum-bob {
    position: absolute;
    bottom: 0;
    left: 50%;
    width: 20px;
    height: 20px;
    background: radial-gradient(circle, var(--warning-color), #d97706);
    border-radius: 50%;
    transform: translateX(-50%);
    box-shadow: 0 0 15px var(--warning-color);
    animation: pendulumBob 4s ease-in-out infinite;
}

.pendulum-shadow {
    position: absolute;
    bottom: -10px;
    left: 50%;
    width: 30px;
    height: 8px;
    background: rgba(0, 0, 0, 0.2);
    border-radius: 50%;
    transform: translateX(-50%);
    animation: pendulumShadow 4s ease-in-out infinite;
}

/* Newton's Cradle */
.newtons-cradle {
    position: absolute;
    top: 30%;
    right: 20%;
    width: 120px;
    height: 100px;
    animation: cradleFloat 15s ease-in-out infinite;
}

.cradle-frame {
    position: relative;
    width: 100%;
    height: 80px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
}

.cradle-ball {
    position: relative;
    width: 20px;
}

.ball-string {
    width: 1px;
    height: 60px;
    background: var(--gray-500);
    margin: 0 auto;
    transform-origin: top center;
}

.ball {
    width: 16px;
    height: 16px;
    background: radial-gradient(circle, #c0c0c0, #808080);
    border-radius: 50%;
    margin: 0 auto;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
}

.ball-1 .ball-string {
    animation: cradleBall1 3s ease-in-out infinite;
}

.ball-5 .ball-string {
    animation: cradleBall5 3s ease-in-out infinite;
}

.cradle-base {
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 100%;
    height: 8px;
    background: var(--gray-600);
    border-radius: 4px;
}

/* Solar System */
.solar-system {
    position: absolute;
    top: 60%;
    left: 10%;
    width: 150px;
    height: 150px;
    animation: solarFloat 20s ease-in-out infinite;
}

.sun {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    background: radial-gradient(circle, #ffd700, #ff8c00);
    border-radius: 50%;
    transform: translate(-50%, -50%);
    box-shadow: 0 0 20px #ffd700;
    animation: sunPulse 3s ease-in-out infinite;
}

.planet-orbit {
    position: absolute;
    top: 50%;
    left: 50%;
    border: 1px solid rgba(99, 102, 241, 0.3);
    border-radius: 50%;
    transform: translate(-50%, -50%);
}

.orbit-planet-1 {
    width: 60px;
    height: 60px;
    animation: orbitRotate 8s linear infinite;
}

.orbit-planet-2 {
    width: 90px;
    height: 90px;
    animation: orbitRotate 12s linear infinite;
}

.orbit-planet-3 {
    width: 120px;
    height: 120px;
    animation: orbitRotate 16s linear infinite;
}

.planet {
    position: absolute;
    border-radius: 50%;
    top: -4px;
    left: 50%;
    transform: translateX(-50%);
}

.planet-1 {
    width: 8px;
    height: 8px;
    background: radial-gradient(circle, #ff6b6b, #ee5a52);
}

.planet-2 {
    width: 10px;
    height: 10px;
    background: radial-gradient(circle, #4ecdc4, #44a08d);
}

.planet-3 {
    width: 12px;
    height: 12px;
    background: radial-gradient(circle, #45b7d1, #2980b9);
}

/* Quantum Particles */
.quantum-field {
    position: absolute;
    top: 20%;
    right: 30%;
    width: 100px;
    height: 100px;
}

.quantum-particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: var(--accent-color);
    border-radius: 50%;
    box-shadow: 0 0 8px var(--accent-color);
}

.q-1 {
    top: 20%;
    left: 20%;
    animation: quantumFloat1 6s ease-in-out infinite;
}

.q-2 {
    top: 60%;
    right: 20%;
    animation: quantumFloat2 8s ease-in-out infinite;
}

.q-3 {
    bottom: 20%;
    left: 60%;
    animation: quantumFloat3 10s ease-in-out infinite;
}

.q-4 {
    top: 40%;
    left: 80%;
    animation: quantumFloat4 7s ease-in-out infinite;
}

/* Validation Errors */
.validation-errors {
    background: rgba(239, 68, 68, 0.1);
    border: 1px solid rgba(239, 68, 68, 0.3);
    border-radius: 12px;
    padding: 20px;
    margin-bottom: 25px;
}

.error-container {
    display: flex;
    align-items: flex-start;
    gap: 12px;
}

.error-container i {
    color: var(--danger-color);
    font-size: 20px;
    margin-top: 2px;
}

.error-content h4 {
    color: var(--danger-color);
    font-size: 16px;
    font-weight: 600;
    margin-bottom: 8px;
}

.error-content ul {
    list-style: none;
    padding: 0;
    margin: 0;
}

.error-content li {
    color: var(--danger-color);
    font-size: 14px;
    margin-bottom: 4px;
    padding-right: 15px;
    position: relative;
}

.error-content li::before {
    content: "•";
    position: absolute;
    right: 0;
    color: var(--danger-color);
}

.input-container input.error {
    border-color: var(--danger-color);
    box-shadow: 0 0 0 3px rgba(239, 68, 68, 0.1);
}

/* Animation Keyframes */
@keyframes pendulumFloat {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-15px) rotate(2deg); }
}

@keyframes pendulumSwing {
    0%, 100% { transform: rotate(-15deg); }
    50% { transform: rotate(15deg); }
}

@keyframes pendulumBob {
    0%, 100% { transform: translateX(-50%) translateY(0px); }
    50% { transform: translateX(-50%) translateY(-5px); }
}

@keyframes pendulumShadow {
    0%, 100% { opacity: 0.2; transform: translateX(-50%) scaleX(1); }
    50% { opacity: 0.4; transform: translateX(-50%) scaleX(1.2); }
}

@keyframes cradleFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-10px); }
}

@keyframes cradleBall1 {
    0%, 40%, 100% { transform: rotate(0deg); }
    20% { transform: rotate(-30deg); }
}

@keyframes cradleBall5 {
    0%, 60%, 100% { transform: rotate(0deg); }
    80% { transform: rotate(30deg); }
}

@keyframes solarFloat {
    0%, 100% { transform: translateY(0px) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(180deg); }
}

@keyframes sunPulse {
    0%, 100% { transform: translate(-50%, -50%) scale(1); box-shadow: 0 0 20px #ffd700; }
    50% { transform: translate(-50%, -50%) scale(1.1); box-shadow: 0 0 30px #ffd700; }
}

@keyframes quantumFloat1 {
    0%, 100% { transform: translate(0, 0); opacity: 0.8; }
    25% { transform: translate(20px, -15px); opacity: 1; }
    50% { transform: translate(-10px, -25px); opacity: 0.6; }
    75% { transform: translate(-20px, 10px); opacity: 1; }
}

@keyframes quantumFloat2 {
    0%, 100% { transform: translate(0, 0); opacity: 0.6; }
    33% { transform: translate(-25px, 20px); opacity: 1; }
    66% { transform: translate(15px, -20px); opacity: 0.8; }
}

@keyframes quantumFloat3 {
    0%, 100% { transform: translate(0, 0); opacity: 1; }
    50% { transform: translate(30px, -30px); opacity: 0.4; }
}

@keyframes quantumFloat4 {
    0%, 100% { transform: translate(0, 0); opacity: 0.7; }
    25% { transform: translate(-15px, 25px); opacity: 1; }
    75% { transform: translate(25px, -15px); opacity: 0.5; }
}

/* Mobile Responsive */
@media (max-width: 1024px) {
    .login-container {
        grid-template-columns: 1fr;
        gap: 40px;
    }
    
    .welcome-side {
        order: -1;
    }
}

@media (max-width: 768px) {
    .main {
        padding-top: 80px;
    }
    
    .login-form-wrapper {
        padding: 30px 20px;
    }
    
    .welcome-side {
        padding: 30px 20px;
    }
    
    .login-title {
        font-size: 24px;
    }
    
    .login-icon {
        width: 60px;
        height: 60px;
        font-size: 24px;
    }
    
    /* Hide some physics elements on mobile */
    .newtons-cradle,
    .solar-system,
    .quantum-field {
        display: none;
    }
}

@media (max-width: 480px) {
    .login-form-wrapper {
        padding: 25px 15px;
    }
    
    .welcome-side {
        padding: 25px 15px;
    }
    
    .login-title {
        font-size: 20px;
    }
    
    .stats-container {
        grid-template-columns: 1fr;
        gap: 10px;
    }
    
    /* Hide more physics elements on very small screens */
    .pendulum,
    .formula {
        display: none;
    }
}

</style>
<!-- Enhanced Physics Background -->
<div class="physics-background">
    <!-- Enhanced Atoms -->
    <div class="atom atom-1">
        <div class="nucleus"></div>
        <div class="electron-orbit orbit-1">
            <div class="electron"></div>
        </div>
        <div class="electron-orbit orbit-2">
            <div class="electron"></div>
        </div>
        <div class="electron-orbit orbit-3">
            <div class="electron"></div>
        </div>
        <div class="atom-glow"></div>
    </div>
    <div class="atom atom-2">
        <div class="nucleus"></div>
        <div class="electron-orbit orbit-1">
            <div class="electron"></div>
        </div>
        <div class="electron-orbit orbit-2">
            <div class="electron"></div>
        </div>
        <div class="atom-glow"></div>
    </div>
    <div class="atom atom-3">
        <div class="nucleus"></div>
        <div class="electron-orbit orbit-1">
            <div class="electron"></div>
        </div>
        <div class="electron-orbit orbit-2">
            <div class="electron"></div>
        </div>
        <div class="atom-glow"></div>
    </div>

    <!-- Enhanced Pendulums -->
    <div class="pendulum pendulum-1">
        <div class="pendulum-string"></div>
        <div class="pendulum-bob"></div>
        <div class="pendulum-shadow"></div>
    </div>
    <div class="pendulum pendulum-2">
        <div class="pendulum-string"></div>
        <div class="pendulum-bob"></div>
        <div class="pendulum-shadow"></div>
    </div>
    <div class="pendulum pendulum-3">
        <div class="pendulum-string"></div>
        <div class="pendulum-bob"></div>
        <div class="pendulum-shadow"></div>
    </div>

    <!-- Enhanced Newton's Cradle -->
    <div class="newtons-cradle">
        <div class="cradle-frame">
            <div class="cradle-ball ball-1">
                <div class="ball-string"></div>
                <div class="ball"></div>
            </div>
            <div class="cradle-ball ball-2">
                <div class="ball-string"></div>
                <div class="ball"></div>
            </div>
            <div class="cradle-ball ball-3">
                <div class="ball-string"></div>
                <div class="ball"></div>
            </div>
            <div class="cradle-ball ball-4">
                <div class="ball-string"></div>
                <div class="ball"></div>
            </div>
            <div class="cradle-ball ball-5">
                <div class="ball-string"></div>
                <div class="ball"></div>
            </div>
        </div>
        <div class="cradle-base"></div>
    </div>

    <!-- Enhanced Electric Sparks -->
    <div class="electric-spark spark-1">
        <div class="spark-line"></div>
        <div class="spark-line"></div>
        <div class="spark-line"></div>
        <div class="spark-center"></div>
    </div>
    <div class="electric-spark spark-2">
        <div class="spark-line"></div>
        <div class="spark-line"></div>
        <div class="spark-center"></div>
    </div>
    <div class="electric-spark spark-3">
        <div class="spark-line"></div>
        <div class="spark-line"></div>
        <div class="spark-line"></div>
        <div class="spark-center"></div>
    </div>

    <!-- Enhanced Floating Particles -->
    <div class="particle particle-1"></div>
    <div class="particle particle-2"></div>
    <div class="particle particle-3"></div>
    <div class="particle particle-4"></div>
    <div class="particle particle-5"></div>
    <div class="particle particle-6"></div>
    <div class="particle particle-7"></div>
    <div class="particle particle-8"></div>

    <!-- Enhanced Floating Formulas -->
    <div class="formula formula-1">E = mc²</div>
    <div class="formula formula-2">F = ma</div>
    <div class="formula formula-3">v = λf</div>
    <div class="formula formula-4">P = IV</div>
    <div class="formula formula-5">ΔE = hf</div>
    <div class="formula formula-6">Q = mcΔT</div>
    <div class="formula formula-7">V = IR</div>

    <!-- Enhanced Light Rays -->
    <div class="light-ray ray-1"></div>
    <div class="light-ray ray-2"></div>
    <div class="light-ray ray-3"></div>
    <div class="light-ray ray-4"></div>

    <!-- Enhanced Solar System -->
    <div class="solar-system">
        <div class="sun"></div>
        <div class="planet-orbit orbit-planet-1">
            <div class="planet planet-1"></div>
        </div>
        <div class="planet-orbit orbit-planet-2">
            <div class="planet planet-2"></div>
        </div>
        <div class="planet-orbit orbit-planet-3">
            <div class="planet planet-3"></div>
        </div>
    </div>

    <!-- Quantum Particles -->
    <div class="quantum-field">
        <div class="quantum-particle q-1"></div>
        <div class="quantum-particle q-2"></div>
        <div class="quantum-particle q-3"></div>
        <div class="quantum-particle q-4"></div>
    </div>
</div>

<!-- Enhanced Modern Header -->


<!-- Login Section -->
<main class="main">
    <section class="login section" id="login">
        <div class="container">
            <div class="login-container">
                <div class="login-form-wrapper animate-on-load">
                    <div class="login-header">
                        <div class="login-icon">
                            <i class="ri-login-box-line"></i>
                            <div class="icon-glow"></div>
                        </div>
                        <h2 class="login-title">تسجيل الدخول</h2>
                        <p class="login-subtitle">أهلاً بك مرة أخرى! يرجى إدخال بياناتك.</p>
                    </div>

                    <!-- Display Validation Errors -->
                    @if ($errors->any())
                        <div class="validation-errors animate-delay-1">
                            <div class="error-container">
                                <i class="ri-error-warning-line"></i>
                                <div class="error-content">
                                    <h4>يرجى تصحيح الأخطاء التالية:</h4>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif

                    <form class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        
                        <div class="form-group animate-delay-2">
                            <label for="Phone">رقم الهاتف</label>
                            <div class="input-container">
                                <input type="text" 
                                       id="Phone" 
                                       name="Phone" 
                                       value="{{ old('Phone') }}" 
                                       required 
                                       autocomplete="Phone"
                                       class="{{ $errors->has('Phone') ? 'error' : '' }}">
                                <i class="ri-phone-line input-icon"></i>
                            </div>
                            @error('Phone')
                                <div class="field-error">
                                    <i class="ri-error-warning-line"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
<input type="hidden" name="screen_width" id="screen_width">
<input type="hidden" name="screen_height" id="screen_height">
<input type="hidden" name="device_token" id="device_token">

<script>
document.addEventListener('DOMContentLoaded', function () {
  // مقاسات الشاشة
  document.getElementById('screen_width').value  = window.screen.width;
  document.getElementById('screen_height').value = window.screen.height;

  // token في localStorage
  let token = localStorage.getItem('my_device_token');
  if (!token) {
    token = Math.random().toString(36).slice(2) + Date.now().toString(36);
    localStorage.setItem('my_device_token', token);
  }
  document.getElementById('device_token').value = token;
});
</script>

                        <div class="form-group animate-delay-3">
                            <label for="password">كلمة المرور</label>
                            <div class="input-container">
                                <input type="password" 
                                       id="password" 
                                       name="password" 
                                       required 
                                       autocomplete="current-password"
                                       class="{{ $errors->has('password') ? 'error' : '' }}">
                                <i class="ri-lock-line input-icon"></i>
                                <button type="button" class="toggle-password" id="togglePassword">
                                    <i class="ri-eye-line"></i>
                                </button>
                            </div>
                            @error('password')
                                <div class="field-error">
                                    <i class="ri-error-warning-line"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-options animate-delay-4">
                          

                        <button type="submit" class="btn btn-primary login-submit-btn animate-delay-5">
                            <i class="ri-login-box-line"></i>
                            <span>تسجيل الدخول</span>
                            <div class="btn-glow"></div>
                            <div class="btn-particles">
                                <div class="btn-particle"></div>
                                <div class="btn-particle"></div>
                                <div class="btn-particle"></div>
                            </div>
                        </button>
                    
                        </div>

                   

              

                        <p class="signup-link animate-delay-8">
                            ليس لديك حساب؟ 
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="auth-link">سجل الآن</a>
                            @endif
                        </p>
                    </form>
                </div>

                <!-- Welcome Side -->
                <div class="welcome-side animate-delay-9">
                    <div class="welcome-content">
                        <div class="welcome-icon">
                            <i class="ri-graduation-cap-line"></i>
                            <div class="welcome-glow"></div>
                        </div>
                        <h3>مرحباً بعودتك!</h3>
                        <p>استمر في رحلتك التعليمية مع أفضل شرح للفيزياء</p>
                        
                        <div class="features-list">
                            <div class="feature-item">
                                <i class="ri-check-line"></i>
                                <span>وصول لجميع المحاضرات</span>
                            </div>
                            <div class="feature-item">
                                <i class="ri-check-line"></i>
                                <span>متابعة التقدم الدراسي</span>
                            </div>
                            <div class="feature-item">
                                <i class="ri-check-line"></i>
                                <span>تواصل مباشر مع المعلم</span>
                            </div>
                            <div class="feature-item">
                                <i class="ri-check-line"></i>
                                <span>اختبارات وتمارين تفاعلية</span>
                            </div>
                        </div>

                        <div class="stats-container">
                            <div class="stat-item">
                                <div class="stat-number">2000+</div>
                                <div class="stat-label">طالب نشط</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">98%</div>
                                <div class="stat-label">نسبة النجاح</div>
                            </div>
                            <div class="stat-item">
                                <div class="stat-number">12+</div>
                                <div class="stat-label">سنة خبرة</div>
                            </div>
                        </div>

                        <div class="testimonial">
                            <div class="testimonial-content">
                                <i class="ri-double-quotes-l"></i>
                                <p>"أفضل معلم فيزياء! شرحه واضح ومبسط، وساعدني كثيراً في فهم المادة."</p>
                                <div class="testimonial-author">
                                    <strong>أحمد محمد</strong>
                                    <span>طالب ثانوية عامة</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<!-- Loading Screen -->
<div class="loading-screen" id="loadingScreen">
    <div class="loading-content">
        <div class="loading-atom">
            <div class="loading-nucleus"></div>
            <div class="loading-orbit orbit-1">
                <div class="loading-electron"></div>
            </div>
            <div class="loading-orbit orbit-2">
                <div class="loading-electron"></div>
            </div>
        </div>
        <h2>تسجيل الدخول...</h2>
        <div class="loading-bar">
            <div class="loading-progress"></div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/auth-script.js') }}"></script>
@endsection
