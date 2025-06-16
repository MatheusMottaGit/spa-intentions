import type { LoginRequest, LoginResponse } from "@/types/auth";
import { toast } from "vue-sonner";
import api from "./api";

export async function loginRequest(name: string, pin: string): Promise<LoginResponse | null> {
  try {
    const loginData: LoginRequest = { name, pin };
    const response = await api.post<LoginResponse>("/login", loginData);
    return response.data;
  } catch (error: any) {
    const errorMessage = error.response?.data?.message || "Erro ao fazer login.";
    toast.error(errorMessage);
    return null;
  }
}
