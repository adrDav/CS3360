module Main where

import Board

main = do
 putStrLn("***WELCOME TO OMOK GAME********")
 let board = mkBoard 15
 putStrLn(boardToStr playerToChar board)