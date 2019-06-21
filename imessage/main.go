package main

import (
	"io"
	"net/http"
)

func main() {
	http.HandleFunc("user/login", func(writer http.ResponseWriter, request *http.Request) {
		io.WriteString(writer,"hello world")

	})
	http.ListenAndServe("8080",nil)
}
