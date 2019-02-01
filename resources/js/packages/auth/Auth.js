export default function(Vue) {
    Vue.auth = {
        setToken(token, expiration) {
            localStorage.setItem("token", token);
            localStorage.setItem("expiration", expiration);
            axios
                .get("http://188.166.159.80/api/user", {
                    headers: {
                        Authorization: "Bearer ".concat(this.getToken())
                    }
                })
                .then(response => {
                    console.log(response);
                    localStorage.setItem("user_id", response.data.id);
                })
                .catch(error => {
                    console.log("error " + error);
                });
        },
        getToken() {
            var token = localStorage.getItem("token");
            var expiration = localStorage.getItem("expiration");
            if (!token || !expiration) {
                return null;
            }

            if (Date.now() > parseInt(expiration)) {
                this.destroyToken();
                return null;
            } else {
                return token;
            }
        },
        destroyToken() {
            localStorage.removeItem("token");
            localStorage.removeItem("expiration");
        },
        isAuthenticated() {
            if (this.getToken()) {
                return true;
            } else {
                return false;
            }
        }
    };

    Object.defineProperties(Vue.prototype, {
        $auth: {
            get() {
                return Vue.auth;
            }
        }
    });
}
