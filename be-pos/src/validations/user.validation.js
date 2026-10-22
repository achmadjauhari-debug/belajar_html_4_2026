import Joi from "joi"

//CREATE
export const createSchema = Joi.object({

      name: Joi.string().trim().required().messages({
        "string.empty": "Name cannot be empty"
      }),  
      email: Joi.string().email().required().messages({
        "string.empty": "Email cannot be empty",
        "string.email": "The email format must be an email address",
        "string.required": "Email is required",
      }),
      password: Joi.string().min(8).optional().messages({
        "string.min": "Password length is 8 characters minimum",
      }),
})


//UPDATE

export const updateSchema = Joi.object({})

