import { defineStore } from "pinia";
import type { User } from "@/types/models";
import type { AuthState } from "@/types/auth";

export const useAuthStore = defineStore("auth", {
  state: (): AuthState => {
    const userData = localStorage.getItem("spa-user");
    const tokenData = localStorage.getItem("spa-token");

    return {
      user: userData ? JSON.parse(userData) : null,
      token: tokenData,
    };
  },

  actions: {
    login(user: User, token: string): void {
      this.user = user;
      this.token = token;

      localStorage.setItem("spa-user", JSON.stringify(user));
      localStorage.setItem("spa-token", token);
    },

    logout(): void {
      this.user = null;
      this.token = null;

      localStorage.removeItem("spa-user");
      localStorage.removeItem("spa-token");
    },

    loadUser(): void {
      const userData = localStorage.getItem("spa-user");
      const tokenData = localStorage.getItem("spa-token");

      if (userData && tokenData) {
        this.user = JSON.parse(userData);
        this.token = tokenData;
      }
    },
  },

  getters: {
    isAuthenticated: (state: AuthState): boolean => !!state.token
  },
});
