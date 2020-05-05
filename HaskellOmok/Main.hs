module Main where

import Board
import System.IO
import System.Exit

playerConversion p = if p==1 then " O " else " X "

main = do
 putStrLn("***WELCOME TO OMOK GAME********")
 let board = mkBoard 15
 putStrLn(boardToStr playerToChar board)
 play board mkPlayer

--Board logic, prints winner, draw, or if the game is over.
play board player = do
 l <- readXY board player
 let board2 = mark (fst l) (snd l) board player
 putStrLn(boardToStr playerToChar board2)
 putStrLn("Enter -1 to exit the game")
 if isWonBy board2 player (snd l) (fst l)
 then putStrLn((playerConversion player)++" Won. Congratulation")
 else if isDraw board2 then putStrLn("Draw!!!")
 else if isGameOver board2 then putStrLn("It is Game Over")
 else play board2 (switchPlayer player)

switchPlayer player = if player==1 then 2 else 1
--ReadXY receives input from the user
readXY board player = do
 putStrLn((playerConversion player)++"'s turn:")
 putStrLn("Enter x value that is 0<x<16: ")
 x <- getX
 putStrLn("Enter y value that is 0<y<16: ")
 y <- getX
 if isEmpty y x board 
 then return (x,y)
 else do
  putStrLn("Select coordinates already placed")
  readXY board player

--Validates the input from the user
getX = do
 line <- getLine
 let parsed = reads line :: [(Int, String)] in
  if length parsed == 0
  then getX'
  else let (x, _) = head parsed in
   if x == -1
   then exitProgram
   else if x > 0 && x < (16) then return x
   else getX'
 where
  getX' = do
   putStrLn "Invalid input!"
   getX

exitProgram = do
 putStrLn("\n**********************")
 putStrLn("Thank you for playing the Omok Game. Bye.")
 putStrLn("\n**********************\n")
 exitFailure