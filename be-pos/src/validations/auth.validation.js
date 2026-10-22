import Joi from "joi";

export const loginSchema = Joi.object({
  email: Joi.string().email().required().messages({
    "string.empty": "Email cannot be empty",
    "string.email": "The email format must be an email address",
    "string.required": "Email is required",
  }),
  password: Joi.string().min(8).required().messages({
    "string.empty": "Password cannot be empty",
    "string.min": "Password length is 8 characters minimum",
    "string.required": "Password is required",
  }),
});
