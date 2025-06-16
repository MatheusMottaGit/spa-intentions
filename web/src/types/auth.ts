import type { User } from './models';
import type { ApiResponse } from './api';

export interface AuthState {
  user: User | null;
  token: string | null;
}

export interface LoginRequest {
  name: string;
  pin: string;
}

export interface LoginResponse extends ApiResponse<{
  user: User;
  token: string;
}> {}
