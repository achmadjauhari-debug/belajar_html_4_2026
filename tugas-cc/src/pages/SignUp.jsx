import { useState } from "react";
import { Input } from "../components/ui/input";
import { Label } from "../components/ui/label";
import { Button } from "../components/ui/button";
import {
  Card,
  CardContent,
  CardDescription,
  CardFooter,
  CardHeader,
  CardTitle,
  CardAction,
} from "../components/ui/card";


export default function SignUp() {

  const [form, setForm] = useState({ name: "", email: "", password: "" });
  const [error, setError] = useState("");
  const [loading, setLoading] = useState(false);

  const handleChange = (e) =>
    setForm({ ...form, [e.target.name]: e.target.value });

  const handleSubmit = async (e) => {
    e.preventDefault();
    setError("");
    setLoading(true);

    try {
      const res = await fetch("http://localhost:5000/api/auth/signup", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify(form),
      });
      const data = await res.json();
      if (!res.ok) throw new error(data.message || "something went wrong");
      // success: redirect to login, e.g. navigate("login")
      alert("Account Created! Please Sign In");
    } catch (error) {
      setError(error.message);
    } finally {
      setLoading(false);
    }
  };


return (
  <Card className="shadow-lg border-border p-6">
            <CardHeader className="space-y-1 pb-4">
              <CardTitle className="text-lg font-semibold">
                Register your account
              </CardTitle>
       
  <form onSubmit={handleSubmit}>

    {error && <p style={{ color: "crimson" }}> {error}</p>}

    <Label>Name</Label>
    <Input name="name" value={form.name} onChange={handleChange} required />

    <Label>Email</Label>
    <Input
      type="email"
      name="email"
      value={form.email}
      onChange={handleChange}
      required
    />

    <Label>Password</Label>
    <Input
      type="password"
      name="password"
      value={form.password}
      onChange={handleChange}
      minLength={8}
      required
    />

    <Button type="submit" disabled={loading}>
      {loading ? "Creating..." : "Sign Up"}
    </Button>
  </form>
  </CardHeader></Card>
);
}
